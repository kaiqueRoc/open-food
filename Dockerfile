# Use uma imagem base do PHP com Apache
FROM php:7.4-apache

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie os arquivos do seu projeto para o diretório de trabalho
COPY . .

# Instale as dependências do Laravel usando o Composer
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --optimize-autoloader --no-dev

# Copie o arquivo de configuração do Apache para o diretório correto
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Habilite o módulo rewrite do Apache
RUN a2enmod rewrite

# Defina as permissões corretas para os arquivos do Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Expõe a porta 80 do servidor Apache
EXPOSE 80

# Inicie o servidor Apache
CMD ["apache2-foreground"]
