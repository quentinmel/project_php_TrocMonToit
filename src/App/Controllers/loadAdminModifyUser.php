<?php 

function loadAdminModifyUser() {
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
        if (isset($_POST["modify_user_name"])) {
            $lastname = $_POST["user_name"];
            $userId = $_POST["user_id"];
            updateUserLastName($userId, $lastname);
        }
        if (isset($_POST["modify_user_firstname"])) {
            $firstname = $_POST["user_firstname"];
            $userId = $_POST["user_id"];
            updateUserFirstName($userId, $firstname);
        }
        if (isset($_POST["modify_user_phone"])) {
            $phone = $_POST["user_phone"];
            $userId = $_POST["user_id"];
            updateUserPhone($userId, $phone);
        }
        if (isset($_POST["modify_user_email"])) {
            $email = $_POST["user_email"];
            $userId = $_POST["user_id"];
            updateUserEmail($userId, $email);
        }
        if (isset($_POST["modify_user_admin"])) {
            $isAdmin = $_POST["user_isAdmin"];
            $userId = $_POST["user_id"];
            updateUserIsAdmin($userId, $isAdmin);
        }
    }

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/admin_modify_user.html.twig');

    echo $template->display([
        'users' => GetUsers(),
    ]);
}

?>