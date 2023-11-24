<?php 
    function loadAdminPage() {
        require_once 'App/Models/queries.php';
        require_once 'App/Models/injection.php';

        session_start();

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin.html.twig');

        echo $template->display([
            'user_connect' => isset($_SESSION["user"]),
        ]);
    }

?>