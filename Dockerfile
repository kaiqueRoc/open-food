# Use a imagem base do PHP 8.1 com Alpine Linux
FROM php:8.1-alpine

# Atualize o repositório de pacotes e instale as dependências necessárias
RUN apk update && apk upgrade \
    && apk add --no-cache \
        bash \
        git \
        curl \
        libzip-dev \
        oniguruma-dev \
        unzip \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
        mbstring \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho como o diretório de código do aplicativo
WORKDIR /var/www/html

# Copie os arquivos do aplicativo para o contêiner
COPY . .

# Execute os comandos necessários para instalar dependências do Composer, se necessário
RUN composer install --no-scripts --no-autoloader

# Exponha a porta se necessário
EXPOSE 80

# Defina o comando de inicialização do contêiner
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html/public"]
