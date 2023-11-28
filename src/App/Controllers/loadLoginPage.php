<?php    
    function loadLoginPage() {

        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = GetUserByEmail($email);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = $user;
                    $_SESSION['user']['email'] = $email;
                    header("Location: /");
                } else {
                    echo "Le mot de passe est incorrect";
                }
            } else {
                echo "L'utilisateur n'existe pas";
            }
        }

        $user_connect = isset($_SESSION["user"]);
        if ($user_connect) {
            header("Location: /");
            exit;
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/login.html.twig');

        echo $template->display([]);
    }

?>