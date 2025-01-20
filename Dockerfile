# Step 1: Use an official PHP image with Apache
FROM php:8.1-apache

# Step 2: Install required dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd


# Step 3: Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Step 4: Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# Step 5: Set up the working directory
WORKDIR /var/www/html

# Step 6: Copy Laravel project files to the container
COPY . /var/www/html

# Step 7: Set permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache


# Step 8: Expose the container's port
EXPOSE 80

# Step 9: Start the Apache server
CMD ["apache2-foreground"]
