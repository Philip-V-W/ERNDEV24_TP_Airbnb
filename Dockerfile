# Use the official PHP image as the base image
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy PHP configuration
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Copy Apache configuration
COPY .docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf && a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy the source code
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
