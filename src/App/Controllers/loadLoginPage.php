<?php    
    function loadLoginPage() {

        session_start();
        $user_connect = isset($_SESSION["user"]);
        if ($user_connect) {
            header("Location: /");
            exit;
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/login.html.twig');

        echo $template->display([]);
    }

?>