#!/bin/bash

set -e

# Configuration
REGISTRY="registry.mele.lat"
API_IMAGE_NAME="auto-api"
WEB_IMAGE_NAME="auto-web"
ENV_FILE=".env"

# Architecture mapping
declare -A ARCH_MAP=(
    ["x86_64"]="amd64"
    ["aarch64"]="arm64"
    ["armv7l"]="arm/v7"
    ["armv6l"]="arm/v6"
    ["i386"]="386"
    ["i686"]="386"
)

SYSTEM_ARCH="$(uname -m)"
DOCKER_ARCH="${ARCH_MAP[$SYSTEM_ARCH]:-$SYSTEM_ARCH}"

# Utility functions
log() {
    echo -e "\033[1;34m[INFO]\033[0m $1"
}

error() {
    echo -e "\033[0;31m[ERROR]\033[0m $1"
    exit 1
}

command_exists() {
    command -v "$1" >/dev/null 2>&1
}

update_env_var() {
    local key="$1"
    local value="$2"
    if grep -q "^${key}=" "$ENV_FILE" 2>/dev/null; then
        sed -i.bak "s|^${key}=.*|${key}=${value}|" "$ENV_FILE"
    else
        echo "${key}=${value}" >> "$ENV_FILE"
    fi
}

# Check Docker
command_exists docker || error "Docker is required but not installed."

# Login to registry
log "Logging in to $REGISTRY"
read -p "Username: " USERNAME
read -s -p "Password: " PASSWORD
echo
echo "$PASSWORD" | docker login "$REGISTRY" -u "$USERNAME" --password-stdin

# Build and tag images
build_and_tag() {
    local context_dir=$1
    local image_name=$2
    local full_tag="${REGISTRY}/${image_name}:${DOCKER_ARCH}"

    log "Building image: $full_tag from ${context_dir}/Dockerfile"
    docker build --platform "linux/$DOCKER_ARCH" -t "$full_tag" "$context_dir"

    read -p "Push $image_name to registry? (y/n): " push_image
    if [[ "$push_image" == "y" ]]; then
        docker push "$full_tag"
    else
        log "Skipping push for $image_name"
    fi

    # Update .env
    local var_name
    if [[ "$image_name" == "$WEB_IMAGE_NAME" ]]; then
        var_name="WEB_IMAGE"
    else
        var_name="API_IMAGE"
    fi

    update_env_var "$var_name" "$full_tag"
}

# Ensure .env exists
if [[ ! -f "$ENV_FILE" ]]; then
    log ".env file not found. Creating a new one."
    touch "$ENV_FILE"
fi

# Build both images
build_and_tag "api-server" "$API_IMAGE_NAME"
build_and_tag "web" "$WEB_IMAGE_NAME"

log "Build and push process complete for architecture: $DOCKER_ARCH (system: $SYSTEM_ARCH)"
