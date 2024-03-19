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

1. Clone the project

    ```bash
    git clone https://github.com/quentinmel/project_php_TrocMonToit.git
    ```
    
2. Launch Docker Desktop and start docker:
    ```bash
    sudo service docker start
    ```

3. Build and start the Docker containers / the Apache server:

    ```bash
    docker-compose up -d
    ```
Your code must be located in the src folder generated when executing the
order "*docker-compose up -d*"

4. You must give the necessary authorizations to the src folder:
    ```bash
    sudo chmod 777 -R src
    ```

## Usage

Access the TrocMonToit website by visiting [http://localhost:8080](http://localhost:8080) in your web browser.

