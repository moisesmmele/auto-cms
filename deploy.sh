#!/bin/bash

set -e

# Configuration
REGISTRY="registry.mele.lat"
API_IMAGE_NAME="auto-api"
WEB_IMAGE_NAME="auto-web"
COMPOSE_FILE="compose.production.yml"
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

# Check Docker and Compose
for cmd in docker "docker compose"; do
    command_exists $cmd || error "$cmd is required but not installed."
done

# Pull architecture-specific images
log "Pulling images for architecture: $DOCKER_ARCH"
docker pull "${REGISTRY}/${API_IMAGE_NAME}:${DOCKER_ARCH}" || log "Failed to pull API image, will use local if available."
docker pull "${REGISTRY}/${WEB_IMAGE_NAME}:${DOCKER_ARCH}" || log "Failed to pull Web image, will use local if available."
# Create or update .env file
if [[ ! -f "$ENV_FILE" ]]; then
    log "Creating default .env file..."
    cat <<EOF > "$ENV_FILE"
APP_NAME=shortener-api
APP_ENV=production
APP_DEBUG=false
APP_PORT=8080
DB_DRIVER=mongodb
DB_HOST=mongodb
DB_PORT=27017
DB_NAME=shortener-api
DB_USER=shortener-api
DB_PASSWORD=
MEMCACHED_HOST=memcached
MEMCACHED_PORT=11211
ARCH=$DOCKER_ARCH
API_IMAGE=${REGISTRY}/${API_IMAGE_NAME}:${DOCKER_ARCH}
WEB_IMAGE=${REGISTRY}/${WEB_IMAGE_NAME}:${DOCKER_ARCH}
EOF
    echo ".env created. Please edit DB_PASSWORD."
else
    log "Updating ARCH, API_IMAGE, and WEB_IMAGE in .env file..."
    grep -q "^ARCH=" "$ENV_FILE" && sed -i "s/^ARCH=.*/ARCH=$DOCKER_ARCH/" "$ENV_FILE" || echo "ARCH=$DOCKER_ARCH" >> "$ENV_FILE"
    grep -q "^API_IMAGE=" "$ENV_FILE" && sed -i "s|^API_IMAGE=.*|API_IMAGE=${REGISTRY}/${API_IMAGE_NAME}:${DOCKER_ARCH}|" "$ENV_FILE" || echo "API_IMAGE=${REGISTRY}/${API_IMAGE_NAME}:${DOCKER_ARCH}" >> "$ENV_FILE"
    grep -q "^WEB_IMAGE=" "$ENV_FILE" && sed -i "s|^WEB_IMAGE=.*|WEB_IMAGE=${REGISTRY}/${WEB_IMAGE_NAME}:${DOCKER_ARCH}|" "$ENV_FILE" || echo "WEB_IMAGE=${REGISTRY}/${WEB_IMAGE_NAME}:${DOCKER_ARCH}" >> "$ENV_FILE"
fi

# Set up symlink to compose.yml
if [ -e compose.yml ]; then
    rm -f compose.yml
fi
ln -s "$COMPOSE_FILE" compose.yml
log "Symlink compose.yml -> $COMPOSE_FILE created."

# Stop current deployment
log "Stopping current deployment (if any)..."
docker compose -f "$COMPOSE_FILE" down || true

# Start new deployment
log "Starting deployment..."
docker compose -f "$COMPOSE_FILE" up -d

log "Deployment complete!"
log "App should be accessible at: http://localhost:$(grep APP_PORT "$ENV_FILE" | cut -d= -f2)"