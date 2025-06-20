#!/bin/bash

set -e

# Configuration
REGISTRY="registry.mele.lat"
API_IMAGE_NAME="auto-api"
WEB_IMAGE_NAME="auto-web"

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

# Basic Auth
read -p "Username: " USERNAME
read -s -p "Password: " PASSWORD
echo

AUTH_HEADER="Authorization: Basic $(echo -n "$USERNAME:$PASSWORD" | base64)"

# Utility
log() {
    echo -e "\033[1;34m[INFO]\033[0m $1"
}

delete_image() {
    local repo="$1"
    local tag="$2"

    log "Fetching digest for $repo:$tag"

    DIGEST=$(curl -sI -H "$AUTH_HEADER" \
        -H "Accept: application/vnd.docker.distribution.manifest.v2+json" \
        "https://${REGISTRY}/v2/${repo}/manifests/${tag}" \
        | grep -i Docker-Content-Digest \
        | awk '{print $2}' | tr -d $'\r')

    if [[ -z "$DIGEST" ]]; then
        echo "[ERROR] Failed to fetch digest for $repo:$tag"
        return
    fi

    log "Deleting $repo@$DIGEST"

    curl -s -X DELETE -H "$AUTH_HEADER" \
        "https://${REGISTRY}/v2/${repo}/manifests/${DIGEST}"

    log "Deleted $repo:$tag"
}

# Delete images
delete_image "$API_IMAGE_NAME" "$DOCKER_ARCH"
delete_image "$WEB_IMAGE_NAME" "$DOCKER_ARCH"
