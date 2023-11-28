<?php 
    function loadRentingPage($rentingId) {
        require_once 'App/Models/queries.php';

        session_start();
        $user_connect = isset($_SESSION["user"]);
        if (!$user_connect) {
            header("Location: /login");
            exit;
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/renting.html.twig');

        echo $template->display([
            'renting' => GetRentingById($rentingId),
            'services' => GetServices(),
            'rentings_services' => GetRentingServices(),
            'equipments' => GetEquipments(),
            'rentings_equipments' => GetRentingEquipments(),
            'user_connect' => isset($_SESSION["user"]),
            'types' => GetTypes(),
        ]);
    }
?>