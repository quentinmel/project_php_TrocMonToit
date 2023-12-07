<?php

function GetUsers() {
    $conn = connectDB();
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $users = $result->fetchAll();
    closeDB($conn);

    return $users;
}

function GetUserByEmail($email) {
    $conn = connectDB();
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    $user = $result->fetch();
    closeDB($conn);

    return $user;
}

function GetRentings() {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings";
    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB($conn);

    return $rentings;
}

function GetServices() {
    $conn = connectDB();
    $sql = "SELECT * FROM services";
    $result = $conn->query($sql);
    $services = $result->fetchAll();
    closeDB($conn);

    return $services;
}

function GetEquipments() {
    $conn = connectDB();
    $sql = "SELECT * FROM equipments";
    $result = $conn->query($sql);
    $equipments = $result->fetchAll();
    closeDB($conn);

    return $equipments;
}

function GetRentingServices($renting_id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_services WHERE id_renting = '$renting_id'";
    $result = $conn->query($sql);
    $rentings_services = $result->fetchAll();
    closeDB($conn);

    return $rentings_services;
}

function GetRentingEquipments($renting_id) {
    $conn = connectDB();
    $sql = "SELECT * FROM rentings_equipments WHERE id_rentings = '$renting_id'";
    $result = $conn->query($sql);
    $rentings_equipments = $result->fetchAll();
    closeDB($conn);

    return $rentings_equipments;
}

function GetTypes() {
    $conn = connectDB();
    $sql = "SELECT * FROM types";
    $result = $conn->query($sql);
    $types = $result->fetchAll();
    closeDB($conn);

    return $types;
}

function GetRentingsWithDetails() {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            GROUP BY r.id";
    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB($conn);

    return $rentings;
}

function GetRentingWithDetails($id_renting) {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.id) as service_ids, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE r.id = '$id_renting'
            GROUP BY r.id";
    $result = $conn->query($sql);
    $renting = $result->fetch();
    closeDB($conn);

    return $renting;
}

function GetRentingWithDetailsByName($renting_name) {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.id) as service_ids, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE r.name = '$renting_name'
            GROUP BY r.id";
    $result = $conn->query($sql);
    $renting = $result->fetch();
    closeDB($conn);

    return $renting;
}

function GetReviews() {
    $conn = connectDB();
    $sql = "SELECT * FROM reviews";
    $result = $conn->query($sql);
    $reviews = $result->fetchAll();
    closeDB($conn);

    return $reviews;
}

function GetReviewsByRentingId($renting_id) {
    $conn = connectDB();
    $sql = "SELECT * FROM reviews WHERE id_renting = '$renting_id'";
    $result = $conn->query($sql);
    $reviews = $result->fetchAll();
    closeDB($conn);

    return $reviews;
}

function GetBookingsByUserId($user_id) {
    $conn = connectDB();
    $sql = "SELECT t.name as type_name, r.price as renting_price, r.address as renting_address, r.id_type as renting_type, r.name as renting_name, r.id as renting_id, r.id_type, DATE_FORMAT(b.start_date, '%d/%m/%Y') as start_date, DATE_FORMAT(b.end_date, '%d/%m/%Y') as end_date, b.id_user, b.id_renting, b.id
        FROM bookings b
        LEFT JOIN rentings r ON b.id_renting = r.id
        LEFT JOIN types t ON r.id_type = t.id
        WHERE b.id_user = '$user_id'
        ORDER BY YEAR(b.start_date) ASC, MONTH(b.start_date) ASC, DAY(b.start_date) ASC";
    $result = $conn->query($sql);
    $bookings = $result->fetchAll();
    closeDB($conn);

    return $bookings;
}

function GetBookedDates($renting_id) {
    $conn = connectDB();
    $sql = "SELECT start_date, end_date FROM bookings WHERE id_renting = '$renting_id'";
    $result = $conn->query($sql);
    $bookings = $result->fetchAll();
    closeDB($conn);

    return $bookings;
}

function GetBookedDatesDisplay($renting_id) {
    $conn = connectDB();
    $sql = "SELECT DATE_FORMAT(start_date, '%d/%m/%Y') as start_date, DATE_FORMAT(end_date, '%d/%m/%Y') as end_date 
        FROM bookings 
        WHERE id_renting = '$renting_id' 
        ORDER BY YEAR(start_date) ASC, MONTH(start_date) ASC, DAY(start_date) ASC";
    $result = $conn->query($sql);
    $bookings = $result->fetchAll();
    closeDB($conn);

    return $bookings;
}

function GetBookedDatesFaker() {
    $conn = connectDBFaker();
    $sql = "SELECT start_date, end_date FROM bookings";
    $result = $conn->query($sql);
    $bookings = $result->fetchAll();
    closeDB($conn);

    return $bookings;
}

function GetFavoritesByUserId($user_id) {
    $conn = connectDB();
    $sql = "SELECT f.*, r.price as renting_price, r.address as renting_address, r.id_type as renting_type, r.name as renting_name, r.id as renting_id, r.id_type, r.picture as renting_picture
            FROM favorites f
            LEFT JOIN rentings r ON f.id_renting = r.id
            WHERE f.id_user = '$user_id'";
    $result = $conn->query($sql);
    $favorites = $result->fetchAll();
    closeDB($conn);

    return $favorites;
}

function GetRentingsWithDetailsByPrice($price_min, $price_max) {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.id) as service_ids, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE r.price BETWEEN '$price_min' AND '$price_max'
            GROUP BY r.id";
    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB($conn);

    return $rentings;
}

function GetRentingsWithDetailsByType($type) {
    $conn = connectDB();
    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, GROUP_CONCAT(DISTINCT e.name) as equipment_names, GROUP_CONCAT(DISTINCT s.id) as service_ids, GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE r.id_type = '$type'
            GROUP BY r.id";    
    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB($conn);

    return $rentings;
}

function GetRentingsWithDetailsByServices($services) {
    $conn = connectDB();

    if (!is_array($services) || empty($services)) {
        return [];
    }

    $serviceIds = implode(',', array_map('intval', $services));

    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, 
                   GROUP_CONCAT(DISTINCT e.name) as equipment_names, 
                   GROUP_CONCAT(DISTINCT s.id) as service_ids, 
                   GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE rs.id_service IN ($serviceIds)
            GROUP BY r.id
            HAVING COUNT(DISTINCT rs.id_service) = " . count($services) . "
                   AND COUNT(DISTINCT s.id) = " . count($services);

    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB($conn);

    return $rentings;
}

function GetRentingsWithDetailsByEquipments($equipments) {
    $conn = connectDB();

    if (!is_array($equipments) || empty($equipments)) {
        return [];
    }

    $equipmentIds = implode(',', array_map('intval', $equipments));

    $sql = "SELECT r.*, t.name as type_name, GROUP_CONCAT(DISTINCT e.id) as equipment_ids, 
                   GROUP_CONCAT(DISTINCT e.name) as equipment_names, 
                   GROUP_CONCAT(DISTINCT s.id) as service_ids, 
                   GROUP_CONCAT(DISTINCT s.name) as service_names
            FROM rentings r
            LEFT JOIN types t ON r.id_type = t.id
            LEFT JOIN rentings_equipments re ON r.id = re.id_rentings
            LEFT JOIN equipments e ON re.id_equipment = e.id
            LEFT JOIN rentings_services rs ON r.id = rs.id_renting
            LEFT JOIN services s ON rs.id_service = s.id
            WHERE re.id_equipment IN ($equipmentIds)
            GROUP BY r.id
            HAVING COUNT(DISTINCT re.id_equipment) = " . count($equipments) . "
                   AND COUNT(DISTINCT e.id) = " . count($equipments);

    $result = $conn->query($sql);
    $rentings = $result->fetchAll();
    closeDB($conn);

    return $rentings;
}

function checkRentingExists($id_renting) {
    $conn = connectDBFaker();
    $sql = "SELECT * FROM rentings WHERE id = '$id_renting'";
    $result = $conn->query($sql);
    $renting = $result->fetch();
    closeDB($conn);

    return $renting;
}

function checkServiceExists($id_service) {
    $conn = connectDBFaker();
    $sql = "SELECT * FROM services WHERE id = '$id_service'";
    $result = $conn->query($sql);
    $service = $result->fetch();
    closeDB($conn);

    return $service;
}

function checkEquipmentExists($id_equipment) {
    $conn = connectDBFaker();
    $sql = "SELECT * FROM equipments WHERE id = '$id_equipment'";
    $result = $conn->query($sql);
    $equipment = $result->fetch();
    closeDB($conn);

    return $equipment;
}

function checkUserExists($id_user) {
    $conn = connectDBFaker();
    $sql = "SELECT * FROM users WHERE id = '$id_user'";
    $result = $conn->query($sql);
    $user = $result->fetch();
    closeDB($conn);

    return $user;
}

function GetLastIdRentingsFaker() {
    $conn = connectDBFaker();
    $sql = "SELECT MAX(id) FROM rentings";
    $result = $conn->query($sql);
    $last_id = $result->fetch();
    closeDB($conn);

    return $last_id;
}

function GetLastIdServicesFaker() {
    $conn = connectDBFaker();
    $sql = "SELECT MAX(id) FROM services";
    $result = $conn->query($sql);
    $last_id = $result->fetch();
    closeDB($conn);

    return $last_id;
}

function GetLastIdEquipmentsFaker() {
    $conn = connectDBFaker();
    $sql = "SELECT MAX(id) FROM equipments";
    $result = $conn->query($sql);
    $last_id = $result->fetch();
    closeDB($conn);

    return $last_id;
}

function GetLastIdUsersFaker() {
    $conn = connectDBFaker();
    $sql = "SELECT MAX(id) FROM users";
    $result = $conn->query($sql);
    $last_id = $result->fetch();
    closeDB($conn);

    return $last_id;
}