<?php 

require_once 'vendor/autoload.php';
require_once 'App/Models/injection.php';
require_once 'App/Models/queries.php';

function fakerAddUser() {

    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) {
        $lastname = $faker->lastName;
        $firstname = $faker->firstName;
        $phone = $faker->phoneNumber;
        $email = $faker->email;
        $password = $faker->password;

        $password = password_hash($password, PASSWORD_DEFAULT);

        addUser($lastname, $firstname, $phone, $email, $password);

    }
}

function fakerAddRenting() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $price = $faker->numberBetween(10, 1000);
        $address = $faker->address;
        $name = $faker->name;
        $id_type = $faker->numberBetween(1, 5);
        $description = $faker->text(200);

        addRenting($address, $name, $price, $id_type, $description);
    }
}

function fakerAddType() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 3; $i++) { 
        $name = $faker->name;
        addType($name);
    }
}

function fakerAddEquipment() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $name = $faker->name;
        addEquipment($name);
    }
}

function fakerAddService() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $name = $faker->name;
        addService($name);
    }
}

function fakerAddRentingService() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $id_renting = $faker->numberBetween(1, 5);
        $id_service = $faker->numberBetween(1, 5);
        addRentingService($id_renting, $id_service);
    }
}

function fakerAddRentingEquipment() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $id_renting = $faker->numberBetween(1, 5);
        $id_equipment = $faker->numberBetween(1, 5);
        addRentingEquipment($id_renting, $id_equipment);
    }
}

?>