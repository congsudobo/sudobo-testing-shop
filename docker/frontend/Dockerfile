FROM node:12

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

# Add entrypoint
COPY docker-entrypoint /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint
ENTRYPOINT ["docker-entrypoint"]