<?php 
    function loadHomePage() {
        require_once 'App/Models/queries.php';

        session_start();

        $rentings = GetRentingsWithDetails();
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["price"])) {
                $min_price = $_POST["min_price"];
                $max_price = $_POST["max_price"];
                if ($min_price == 0 && $max_price == 0) {
                    $rentings = GetRentingsWithDetails();
                    $error = "Veuillez entrer un prix maximum.";
                } else if ($min_price > $max_price) {
                    $error = "Le prix minimum doit être inférieur au prix maximum.";
                } else {
                    $rentings = GetRentingsWithDetailsByPrice($min_price, $max_price);
                }
            }
            if (isset($_POST["type"])) {
                $type = $_POST["id_type"];
                if ($type == "all") {
                    $rentings = GetRentingsWithDetails();
                } else {
                    $rentings = GetRentingsWithDetailsByType($type);
                }
            }
            if (isset($_POST["service"])) {
                $service = $_POST["id_service"];
                if ($service == "all") {
                    $rentings = GetRentingsWithDetails();
                } else {
                    $rentings = GetRentingsWithDetailsByService($service);
                }
            }
            if (isset($_POST["equipment"])) {
                $equipment = $_POST["id_equipment"];
                if ($equipment == "all") {
                    $rentings = GetRentingsWithDetails();
                } else {
                    $rentings = GetRentingsWithDetailsByEquipment($equipment);
                }
            }
        }

        foreach ($rentings as &$renting) {
            $renting['encoded_picture'] = base64_encode($renting['picture']);
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/home.html.twig');

        echo $template->display([
            'rentings' => $rentings,
            'user_connect' => isset($_SESSION["user"]),
            'types' => GetTypes(),
            'services' => GetServices(),
            'equipments' => GetEquipments(),
            'error' => $error,
        ]);
    }

?>