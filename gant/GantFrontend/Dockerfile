
# Stage 2
FROM nginx:1.23.0-alpine
COPY ./build /usr/share/nginx/html
RUN rm /etc/nginx/conf.d/default.conf

COPY nginx/default.conf /etc/nginx/conf.d

CMD ["nginx", "-g", "daemon off;"]
