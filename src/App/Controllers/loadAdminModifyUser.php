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
        $user_id = $_POST["user_id_modify"];
        if (isset($_POST["modify_user_name"])) {
            $lastname = $_POST["user_name"];
            updateUserLastName($user_id, $lastname);
        }
        if (isset($_POST["modify_user_firstname"])) {
            $firstname = $_POST["user_firstname"];
            var_dump($user_id);
            var_dump($firstname);
            updateUserFirstName($user_id, $firstname);
        }
        if (isset($_POST["modify_user_phone"])) {
            $phone = $_POST["user_phone"];
            updateUserPhone($user_id, $phone);
        }
        if (isset($_POST["modify_user_email"])) {
            $email = $_POST["user_email"];
            $user_id = $_POST["user_id"];
            updateUserEmail($user_id, $email);
        }
        if (isset($_POST["modify_user_password"])) {
            $password = $_POST["user_password"];
            $password = password_hash($password, PASSWORD_DEFAULT);
            updateUserPassword($user_id, $password);
        }
        if (isset($_POST["modify_user_admin"])) {
            $isAdmin = $_POST["user_isAdmin"];
            updateUserIsAdmin($user_id, $isAdmin);
        }
        if (isset($_POST["delete_user"])) {
            removeFavoriteUser($user_id);
            removeBookingUser($user_id);
            removeUser($user_id);
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