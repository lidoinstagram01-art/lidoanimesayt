# PHP va Apache serverini o'rnatish
FROM php:8.2-apache

# MySQL bazaga ulanish uchun PDO kengaytmalarini yoqish
RUN docker-php-ext-install pdo pdo_mysql

# .htaccess (chiroyli URL manzillar) ishlashi uchun mod_rewrite ni yoqish
RUN a2enmod rewrite

# Barcha fayllarni serverning asosiy papkasiga ko'chirish
COPY . /var/www/html/
