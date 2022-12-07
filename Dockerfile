# FROM nginx:latest

# # FROM php:7.4-cli

# WORKDIR /usr/share/nginx/html/pages/home

# COPY ./default.conf /etc/nginx/conf.d/default.conf 

# EXPOSE 4000


# CMD [ "executable" ]



FROM php:7.4-apache

# COPY ./php/src/pages /var/www/html/

WORKDIR /var/www/html/

# RUN apt-get update && apt-get upgrade

# RUN docker-php-ext-install mysqli

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
# COPY . .

EXPOSE 8000
