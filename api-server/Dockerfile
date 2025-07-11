FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libmemcached-dev \
    libssl-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    pkg-config \
    nginx \
    supervisor \
    netcat-traditional \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip curl

# Install Http extension
RUN pecl install raphf && docker-php-ext-enable raphf
RUN pecl install pecl_http && docker-php-ext-enable http

# Install Composer
COPY --from=docker.io/composer:latest /usr/bin/composer /usr/bin/composer
# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better caching
COPY composer.json ./
COPY composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application code
COPY src ./src
COPY public ./public
COPY database ./database
COPY cors.php .
COPY phinx.php .

# Copy nginx config
COPY nginx.default.conf /etc/nginx/sites-available/default

# Copy supervisord config
COPY supervisord.default.conf /etc/supervisor/conf.d/supervisord.conf

# Copy PHP INI config
COPY php.default.ini /usr/local/etc/php/conf.d/

# Copy entrypoint script
COPY entrypoint.sh .

# Set entrypoint executable permission
RUN chmod +x ./entrypoint.sh

# CREATE STORAGE DIRECTORY AND SET PERMISSIONS
RUN mkdir -p /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && mkdir -p /var/log/supervisor /run/nginx

# Configure PHP-FPM to listen on TCP
RUN sed -i 's/listen = \/run\/php\/php8.4-fpm.sock/listen = 127.0.0.1:9000/' /usr/local/etc/php-fpm.d/www.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p /var/log/supervisor /run/nginx

# Expose port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# Start supervisord
ENTRYPOINT ["./entrypoint.sh"]