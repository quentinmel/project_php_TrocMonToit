<?php    
    function loadAdminCreateUser() {
        require_once("App/Models/injection.php");
        require_once("App/Models/queries.php");

        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email_already_used = false;

            foreach (GetUsers() as $user) {
                if ($email == $user['email']) {
                    $email_already_used = true;
                    $error = "Email déjà utilisé !";
                }
            }

            if ($email_already_used == false) {
                addUser($lastname, $firstname, $phone, $email, $password);
                header("Location: /admin");
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin_create_user.html.twig');

        echo $template->display([
            'error' => $error,
        ]);
    }

?>