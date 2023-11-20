<?php 
    function load404Page() {

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/404.html.twig');

        $template->display([]);
    }

?>