# TrocMonToit

TrocMonToit is a PHP and MySQL website for book accommodation.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)

## Features

- **Faker**
    - If you want to fill the database with random information, you can use this command in the src folder:
      ```bash
        php App/Controllers/faker.php
      ```
    - This command allows you to put 5 users, 5 rentings, a maximum of 10 equipment and 10 services assigned to the rentings and a maximum of 10 reservations on the rentings and users.

- **Admin**
    - A CRUD (Create, Read, Update, Delete) on housing types
    - A CRUD on the equipment made available
    - A CRUD on the services made available
    - A CRUD on users
    - A CRUD on housing and all of its characteristics
    - A CRUD on reviews
    - A search on accommodation names

- **Filters**
    - Search by City
    - Search by Renting Types
    - Search by Services
    - Search by Equipments
    - Search by Price

- **Renting**
    - Picture of the renting
    - Favorite
    - Type
    - Name
    - Description
    - Price per night
    - Reservation availability date
    - Review

- **Reservation**
    - Be able to reserve accommodation if you are connected and if the accommodation has not been reserved on these dates.

- **Reviews**
    - Be able to add a notice when you have booked and the end date of your reservation has passed.

- **Profile**
    - Lastname
    - Forname
    - E-mail
    - Phone      
    - Displaying your favorites
    - Displaying your reservations
    - Displaying your reviews

## Prerequisites

Before you begin, ensure you have met the following requirements:

- Docker Desktop application
- Docker / Docker Compose
- PHP
- Apache

## Installation

1. Create a empty folder that will contain the project, clone the repository in this folder (this will be your src folder):

    ```bash
    git clone https://github.com/B2-Info-23-24/php-quentinmel.git
    ```

2. In this folder, create a docker-compose.yml file with the following content:
    ```bash
        version: '3'
    
    services:
      web:
        build: .
        ports:
          - "8080:80" # Expose port 8080 on WSL to port 80 in the container
        volumes:
          - ./src:/var/www/html
    
      mysql:
        image: mysql:5.7
        environment:
          MYSQL_ROOT_PASSWORD: my-secret-pw
          MYSQL_DATABASE: my_database
          MYSQL_USER: my_user
          MYSQL_PASSWORD: my_password
        volumes:
          - db_data:/var/lib/mysql
        ports:
          - "3306:3306" # Expose port 3306 on the host to port 3306 in the container
    
    volumes:
      db_data:
    ```

3. Create a Dockerfile with the following content:
    ```bash
    FROM php:8.0-apache

    RUN a2enmod rewrite
    
    RUN docker-php-ext-install pdo pdo_mysql

    ```
    
4. Launch Docker Desktop and start docker:
    ```bash
    sudo service docker start
    ```

5. Build and start the Docker containers / the Apache server:

    ```bash
    docker-compose up -d
    ```
Your code must be located in the src folder generated when executing the
order "*docker-compose up -d*"

6. You must give the necessary authorizations to the src folder:
    ```bash
    sudo chmod 777 -R src
    ```

## Usage

Access the TrocMonToit website by visiting [http://localhost:8080](http://localhost:8080) in your web browser.

