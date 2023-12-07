<?php 

    function loadAdminModifyReview() {
        require_once 'App/Models/queries.php';
        require_once 'App/Models/injection.php';

        $error = "";
        
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
                $id = $_POST["delete_review"];
                removeReview($id);
                header("Location: /admin");
            }
            if (isset($_POST["modify"])) {
                $id = $_POST["modify_review"];
                $new_comment = $_POST["modify_review_comment"];
                $new_rating = $_POST["modify_review_note"];
                if ($new_rating < 0 || $new_rating > 5) {
                    $error = "La note doit être comprise entre 0 et 5.";
                }
                modifyReview($id, $new_comment, $new_rating);
                header("Location: /admin");
            }
            if (isset($_POST["add_review"])) {
                $comment = $_POST["add_review_comment"];
                $note = $_POST["add_review_note"];
                if ($note < 0 || $note > 5) {
                    $error = "La note doit être comprise entre 0 et 5.";
                }
                $user = GetUserByEmail($_POST["add_review_user"]);
                if ($user !== false && isset($user["id"])) {
                    $user_id = $user["id"];
                    $renting_id = $_POST["add_review_renting"];
                    if (GetRentingWithDetails($renting_id) === false) {
                        $error = "Location non trouvée dans la base de données.";
                    } else {
                        $start_date = date("Y-m-d");
                        $end_date = date("Y-m-d", strtotime($start_date . "+1 day"));
                        $booking = addBooking($start_date, $end_date, $user_id, $renting_id);
                        addReview($note, $comment, $user_id, $renting_id, $booking);
                        header("Location: /admin");
                    }
                } else {
                    $error = "Utilisateur non trouvé dans la base de données.";
                }
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('pages/admin_modify_review.html.twig');

        echo $template->display([
            'reviews' => GetReviews(),
            'error' => $error,
        ]);
    }

?>