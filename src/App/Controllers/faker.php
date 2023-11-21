<?php 

require_once 'vendor/autoload.php';
require_once 'App/Models/injection.php';


function faker() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 10; $i++) {
        $lastname = $faker->lastName;
        $firstname = $faker->firstName;
        $phone = $faker->phoneNumber;
        $email = $faker->email;
        $password = $faker->password;
        $password_confirmation = $password;

        $password = password_hash($password, PASSWORD_DEFAULT);

        addUser($lastname, $firstname, $phone, $email, $password);
    }
}

?>