'''
server {
listen 80;
root /var/www/html/app1;
}

server {
listen 7777;
root /var/www/html/app2;
location /docs {
try_files $uri /index.html$is_args$args;
}
}
'''
