<?php 

    function loadAdminModifyEquipment() {
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
                $id = $_POST["delete_equipment"];
                removeEquipment($id);
                header("Location: /admin");
            }
            if (isset($_POST["modify"])) {
                $id = $_POST["modify_equipment"];
                $new_name = $_POST["modify_equipment_name"];
                modifyEquipment($id, $new_name);
                header("Location: /admin");
            }
            if (isset($_POST["add_equipment"])) {
                $name = $_POST["add_equipment_name"];
                addEquipment($name);
                header("Location: /admin");
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin_modify_equipment.html.twig');

        echo $template->display([
            'equipments' => GetEquipments(),
        ]);
    }

?>