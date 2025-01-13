# Use the official PHP image with Apache
FROM php:8.2-apache

# Install required PHP extensions (if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your project files to the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port 80 for HTTP
EXPOSE 80
