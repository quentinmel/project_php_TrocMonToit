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

        addUserFaker($lastname, $firstname, $phone, $email, $password);

    }
}

function fakerAddRenting() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $price = $faker->numberBetween(10, 100);
        $picture = addslashes(file_get_contents('public/assets/maison.avif'));
        $city = $faker->city;
        $name = $faker->name;
        $id_type = $faker->numberBetween(1, 5);
        $description = $faker->text(200);

        addRentingFaker($city, $name, $price, $id_type, $picture, $description);
    }
}

function fakerAddType() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $name = $faker->name;
        addTypeFaker($name);
    }
}

function fakerAddEquipment() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $name = $faker->name;
        addEquipmentFaker($name);
    }
}

function fakerAddService() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 5; $i++) { 
        $name = $faker->name;
        addServiceFaker($name);
    }
}

function fakerAddRentingEquipment() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 10; $i++) { 
        $id_renting = $faker->numberBetween(1, GetLastIdRentingsFaker()[0]);
        $id_equipment = $faker->numberBetween(1, GetLastIdEquipmentsFaker()[0]);
        if (checkRentingExists($id_renting) && checkEquipmentExists($id_equipment)) {
            addRentingEquipmentFaker($id_renting, $id_equipment);
        }
    }
}

function fakerAddRentingService() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 10; $i++) { 
        $id_renting = $faker->numberBetween(1, GetLastIdRentingsFaker()[0]);
        $id_service = $faker->numberBetween(1, GetLastIdServicesFaker()[0]);
        if (checkRentingExists($id_renting) && checkServiceExists($id_service)) {
            addRentingServiceFaker($id_renting, $id_service);
        }
    }
}

function fakerAddBooking() {
    $faker = Faker\Factory::create('fr_FR');

    for ($i = 0; $i < 10; $i++) {
        $result= false;
        $id_renting = $faker->numberBetween(1, GetLastIdRentingsFaker()[0]);
        $id_user = $faker->numberBetween(1, GetLastIdUsersFaker()[0]);
        $date_start = $faker->dateTimeBetween('now', '+1 years');
        $date_end = $faker->dateTimeBetween($date_start, '+1 years');
        $date_start = $date_start->format('Y-m-d');
        $date_end = $date_end->format('Y-m-d');
        if ($date_start < $date_end && checkRentingExists($id_renting) && checkUserExists($id_user)) {
            if (GetBookedDatesFaker() == null) {
                addBookingFaker($date_start, $date_end, $id_user, $id_renting);
            } else {
                foreach (GetBookedDatesFaker() as $bookedDate) {
                    if ($bookedDate['start_date'] >= $date_start && $bookedDate['end_date'] >= $date_end || $bookedDate['start_date'] <= $date_start && $bookedDate['end_date'] <= $date_end) {
                        $result = true;
                    }
                }
                if ($result == true) {
                    addBookingFaker($date_start, $date_end, $id_user, $id_renting);
                    $result = false;
                }
            }
        }
    }

}

fakerAddUser();
fakerAddRenting();
// fakerAddType();
// fakerAddService();
// fakerAddEquipment();
fakerAddRentingService();
fakerAddRentingEquipment();
fakerAddBooking();
?>