<?php 
    require_once("App/Models/queries.php");
    
    function loadProfilePage() {

        session_start();
        $user_connect = isset($_SESSION["user"]);
        if (!$user_connect) {
            header("Location: /login");
            exit;
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/profile.html.twig');

        echo $template->render([
            'users' => GetUserByEmail($_SESSION["user"]["email"]),
        ]);
    }

?>