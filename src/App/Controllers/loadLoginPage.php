<?php    
    function loadLoginPage() {

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/login.html.twig');

        echo $template->display([]);
    }

?>