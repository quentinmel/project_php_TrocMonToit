<?php 

    function loadAdminModifyService() {
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["delete"])) {
                $id = $_POST["delete_service"];
                removeService($id);
                header("Location: /admin");
            }
            if (isset($_POST["modify"])) {
                $id = $_POST["modify_service"];
                $new_name = $_POST["modify_service_name"];
                modifyService($id, $new_name);
                header("Location: /admin");
            }
            if (isset($_POST["add_service"])) {
                $name = $_POST["add_service_name"];
                addService($name);
                header("Location: /admin");
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin_modify_service.html.twig');

        echo $template->display([
            'services' => GetServices(),
        ]);
    }

?>