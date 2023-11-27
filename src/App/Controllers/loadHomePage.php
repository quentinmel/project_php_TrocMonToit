<?php 
    function loadHomePage() {
        require_once 'App/Models/queries.php';

        session_start();

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/home.html.twig');

        echo $template->display([
            'rentings' => GetRenting(),
            'services' => GetServices(),
            'equipments' => GetEquipments(),
            'user_connect' => isset($_SESSION["user"]),
            'types' => GetTypes(),
        ]);
    }

?>