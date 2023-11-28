<?php 
    function loadRentingPage($rentingId) {
        require_once 'App/Models/queries.php';

        session_start();

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $renting = GetRentingWithDetails($rentingId);
        $renting['encoded_picture'] = base64_encode($renting['picture']);

        $template = $twig->load('pages/renting.html.twig');

        echo $template->display([
            'renting' => $renting,
            'user_connect' => isset($_SESSION["user"]),
        ]);
    }
?>