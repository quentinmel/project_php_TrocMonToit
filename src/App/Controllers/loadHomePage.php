<?php
function loadHomePage()
{
    require_once 'App/Models/queries.php';

    session_start();

    $rentings = GetRentingsWithDetails();
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION['filters'] = [
            'min_price' => $_POST['min_price'],
            'max_price' => $_POST['max_price'],
            'address' => $_POST['address'],
            'id_type' => $_POST['id_type'],
            'service' => isset($_POST['service']) ? $_POST['service'] : [],
            'equipment' => isset($_POST['equipment']) ? $_POST['equipment'] : [],
        ];

        $min_price = $_POST["min_price"];
        $max_price = $_POST["max_price"];
        $address = $_POST["address"];
        $type = $_POST["id_type"];
        $services = isset($_POST["service"]) ? $_POST["service"] : [];
        $equipments = isset($_POST["equipment"]) ? $_POST["equipment"] : [];

        $filteredRentings = [];

        if ($max_price == 0 || $min_price <= $max_price) {
            $filteredRentings = GetRentingsWithDetailsByPrice($min_price, $max_price);

            $rentingsAddress = GetRentingsWithDetailsByAddress($address);

            foreach ($rentingsAddress as $rentingAddress) {
                if ($address != "" && !in_array($rentingAddress, $filteredRentings)) {
                    $filteredRentings[] = $rentingAddress;
                }
            }

            $rentingsTypes = GetRentingsWithDetailsByType($type);

            foreach ($rentingsTypes as $rentingType) {
                if ($type != "all" && !in_array($rentingType, $filteredRentings)) {
                    $filteredRentings[] = $rentingType;
                }
            }

            $servicesRentings = GetRentingsWithDetailsByServices($services);

            foreach ($servicesRentings as $serviceRenting) {
                if (!empty($servicesRenting) && !in_array($serviceRenting, $filteredRentings)) {
                    $filteredRentings[] = $serviceRenting;
                }
            }

            $equipmentRentings = GetRentingsWithDetailsByEquipments($equipments);

            foreach ($equipmentRentings as $equipmentRenting) {
                if (!empty($equipmentRenting) && !in_array($equipmentRenting, $filteredRentings)) {
                    $filteredRentings[] = $equipmentRenting;
                }
            }

            $rentings = $filteredRentings ? $filteredRentings : $rentings;

            if (!empty($filteredRentings)) {
                $error = "";
            } else if ($min_price == 0 && $max_price == 0 && $address == null && $type == "all" && empty($services) && empty($equipments)) {
                $error = "Veuillez saisir au moins un filtre.";
            } else {
                $error = "Aucun résultat ne correspond à votre recherche.";
            }
        } else {
            $error = "Le prix minimum doit être inférieur ou égal au prix maximum.";
        }
    }

    $rentings = array_unique($rentings, SORT_REGULAR);

    foreach ($rentings as &$renting) {
        $renting['encoded_picture'] = base64_encode($renting['picture']);
    }

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/home.html.twig');

    $min_price = isset($_SESSION['filters']['min_price']) ? $_SESSION['filters']['min_price'] : "";
    $max_price = isset($_SESSION['filters']['max_price']) ? $_SESSION['filters']['max_price'] : "";
    $address = isset($_SESSION['filters']['address']) ? $_SESSION['filters']['address'] : "";
    $type = isset($_SESSION['filters']['id_type']) ? $_SESSION['filters']['id_type'] : "all";
    $services = isset($_SESSION['filters']['service']) ? $_SESSION['filters']['service'] : [];
    $equipments = isset($_SESSION['filters']['equipment']) ? $_SESSION['filters']['equipment'] : [];

    $filters = [
        'min_price' => $min_price,
        'max_price' => $max_price,
        'address' => $address,
        'id_type' => $type,
        'service' => $services,
        'equipment' => $equipments,
    ];

    echo $template->display([
        'rentings' => $rentings,
        'user_connect' => isset($_SESSION["user"]),
        'types' => GetTypes(),
        'services' => GetServices(),
        'equipments' => GetEquipments(),
        'error' => $error,
        'filters' => $filters,
    ]);
}
?>