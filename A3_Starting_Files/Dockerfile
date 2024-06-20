# Use an official PHP image as a parent image
FROM php:7.4-apache

# Install the necessary PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy the current directory contents into the container at /var/www/html/
COPY . /var/www/html/

# Set permissions for the web root directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 to the host
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]
