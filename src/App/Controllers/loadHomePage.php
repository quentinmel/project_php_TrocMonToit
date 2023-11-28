<?php 
    function loadHomePage() {
        require_once 'App/Models/queries.php';

        session_start();

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $rentings = GetRentingsWithDetails();
        foreach ($rentings as &$renting) {
            $renting['encoded_picture'] = base64_encode($renting['picture']);
        }

        $template = $twig->load('pages/home.html.twig');

        echo $template->display([
            'rentings' => $rentings,
            'user_connect' => isset($_SESSION["user"]),
            'types' => GetTypes(),
        ]);
    }

?>