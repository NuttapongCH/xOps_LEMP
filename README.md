# xOps_LEMP
 
LEMP

L = Linux OS

E = Nginx Web Server

M = Mysql

P = PHP 


#########################################################################################################

L = Install WSL

E = Nginx 

1.Create Folder XOPS_LEMP/nginx

2.Create File XOPS_LEMP/nginx/default.conf

    server {

    listen 80;
    
    server_name _;
	
	
    root /var/www/html;
    
    location / {
    
        index index.php index.html;
	
    }

	   
    location ~ \.php$ {
    
        include fastcgi_params;
	
        fastcgi_pass php:9000;
	
        fastcgi_index index.php;
	
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	
    }

    location ~ /\.ht {
    
        deny all;
	
    }
    
}

######Copy Edit Config


3.Create File XOPS_LEMP/docker-compose.yml


nginx:

    container_name: nginx_server
    
    image: nginx
    
    volumes:
    
      - ./web:/var/www/html
      
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf

    ports:
    
      - "80:80"

M = Mysql

1.Add CODE XOPS_LEMP/docker-compose.yml


db:

    container_name: db_server
    
    image: mysql    
    
    volumes:
    
      - ./data/:/var/lib/mysql
      
    environment:
    
      - MYSQL_ROOT_PASSWORD=sev1234

P = PHP 

1.Create Folder XOPS_LEMP/php

2.Create XOPS_LEMP/php/Dockerfile 

    FROM php:7.4-fpm-alpine  #version php
    
    RUN docker-php-ext-install mysqli #Module mysqli
    
4.Create Folder XOPS_LEMP/web

5.Create File XOPS_LEMP/web/index.php

        <?php 

    $servername = "db";
    
    $username = "root";
    
    $password = "sev1234";
    
    
    // Create connection
    
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    
    if ($conn->connect_error) {
    
    die("Connection failed: " . $conn->connect_error);
    
    }
    echo "Connected successfully";


    ?>
6.Add CODE XOPS_LEMP/docker-compose.yml

 php:
    
    build: php/
    
    container_name: php
    
    volumes:
    
      - ./web:/var/www/html

##########################################################################################################

Install Contailer

1.Go to Folder XOPS_LEMP

2.Run docker-compose -f docker-compose.yml up -d 

3.Run docker ps Check Status
