<?php 
    require_once("App/Models/queries.php");
    
    function loadProfilePage() {

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        session_start();

        $template = $twig->load('pages/profile.html.twig');

        echo $template->render([
            'users' => GetUserByEmail($_SESSION["email"]),
        ]);
    }

?>