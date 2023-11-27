<?php 
    function loadAdminPage() {
        require_once 'App/Models/queries.php';
        require_once 'App/Models/injection.php';
        
        session_start();
        if (!isset($_SESSION["user"])) {
            header("Location: /");
            exit;
        }
        $isAdmin = $_SESSION["user"]["isAdmin"];
        if (!$isAdmin) {
            header("Location: /");
            exit;
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin.html.twig');

        echo $template->display([]);
    }

?>