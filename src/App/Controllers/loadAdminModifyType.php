<?php 

    function loadAdminModifyType() {
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

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["delete"])) {
                $id = $_POST["delete_type"];
                foreach (GetRentings() as $renting) {
                    if ($renting["id_type"] == $id) {
                        $error = "Impossible de supprimer ce type, il est utilisé par au moins une location !";
                    }
                }
                if ($error == "") {
                    removeType($id);
                    header("Location: /admin");
                }
            }
            if (isset($_POST["modify"])) {
                $id = $_POST["modify_type"];
                $new_name = $_POST["modify_type_name"];
                modifyType($id, $new_name);
                header("Location: /admin");
            }
            if (isset($_POST["add_type"])) {
                $name = $_POST["add_type_name"];
                addType($name);
                header("Location: /admin");
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin_modify_type.html.twig');

        echo $template->display([
            'types' => GetTypes(),
            'error' => $error,
        ]);
    }

?>