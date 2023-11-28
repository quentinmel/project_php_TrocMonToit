<?php    
    function loadSignupPage() {

        session_start();

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/signup.html.twig');

        echo $template->display([]);
    }

?>