<?php    
    function loadSignupPage() {
        require_once("App/Models/injection.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirmation = $_POST['password_confirm'];
            
            $email_already_used = false;

            foreach (GetUsers() as $user) {
                if ($email == $user['email']) {
                    $email_already_used = true;
                    echo "L'email est déjà utilisé";
                }
            }

            if ($password === $password_confirmation && !$email_already_used) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                addUser($lastname, $firstname, $phone, $email, $password);
                header("Location: /login");
            } elseif ($password !== $password_confirmation) {
                echo "Les mots de passe ne sont pas identiques";
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/signup.html.twig');

        echo $template->display([]);
    }

?>