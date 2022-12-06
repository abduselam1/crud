# FROM nginx:latest

# # FROM php:7.4-cli

# WORKDIR /usr/share/nginx/html/pages/home

# COPY ./default.conf /etc/nginx/conf.d/default.conf 

# EXPOSE 4000


# CMD [ "executable" ]



FROM php:7.4-apache

COPY . /var/www/html/

WORKDIR /var/www/html/

# COPY . .

EXPOSE 4000
