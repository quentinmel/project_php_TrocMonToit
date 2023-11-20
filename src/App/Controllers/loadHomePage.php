<?php 
    function loadHomePage() {
        require_once 'App/Models/queries.php';

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/home.html.twig');

        echo $template->render([
            'rentings' => GetRenting(),
            'accommodations' => GetAccommodation()
        ]);
    }

?>