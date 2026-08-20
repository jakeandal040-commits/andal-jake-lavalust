ARG PHP_VERSION=8.5

<<<<<<< HEAD
 

FROM php:${PHP_VERSION}-apache

 

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

 

# Enable Apache mod_rewrite
RUN a2enmod rewrite

 

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

 

# Copy app files
COPY . /var/www/html/

 

=======
FROM php:${PHP_VERSION}-apache

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copy app files
COPY . /var/www/html/

>>>>>>> 57d514730b121cf1a0767a53da40522e71cc94b8
# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

<<<<<<< HEAD
 

# Point Apache document root to public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

 

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot ${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<Directory /var/www/html>|<Directory ${APACHE_DOCUMENT_ROOT}>|g' /etc/apache2/apache2.conf

 

=======
>>>>>>> 57d514730b121cf1a0767a53da40522e71cc94b8
EXPOSE 80