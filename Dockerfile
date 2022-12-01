FROM nginx:latest

# FROM php:7.4-cli

WORKDIR /usr/share/nginx/html/pages/home

COPY ./default.conf /etc/nginx/conf.d/default.conf 

COPY . .

EXPOSE 4000


# CMD [ "executable" ]