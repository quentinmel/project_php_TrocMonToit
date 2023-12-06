<?php 
    function loadRentingPage($rentingId) {
        require_once 'App/Models/queries.php';
        require_once 'App/Models/injection.php';

        session_start();

        $currentDate = date("Y-m-d");
        $bookedDates = GetBookedDates($rentingId);
        $bookedDatesDisplay = GetBookedDatesDisplay($rentingId);
        $error = "";
        $favorite_message = "Ajouter aux favoris";

        if (isset($_SESSION["user"])) {
            $userId = $_SESSION["user"]["id"];
            $favorites = GetFavoritesByUserId($userId);
            foreach ($favorites as $favorite) {
                if ($favorite["id_renting"] == $rentingId) {
                    $favorite_message = "Retirer des favoris";
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['favorite'])) {
                if (!isset($_SESSION["user"])) {
                    $error = "Vous devez être connecté pour cette fonctionnalitée !";
                } else {
                    $userId = $_SESSION["user"]["id"];
                    $favorite = $_POST['favorite'];
                    if ($favorite == "Ajouter aux favoris") {
                        addFavorite($userId, $rentingId);
                        $favorite_message = "Retirer des favoris";
                    } else {
                        removeFavorite($userId, $rentingId);
                        $favorite_message = "Ajouter aux favoris";
                    }
                }
            }
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];

                if (!isset($_SESSION["user"])) {
                    $error = "Vous devez être connecté pour cette fonctionnalitée !";
                } else {   
                    if ($end_date < $start_date) {
                        $error = "La date de fin doit être supérieure à la date de début !";
                    } else if ($start_date < $currentDate) {
                        $error = "La date de début doit être supérieure à la date du jour !";
                    } else {
                        foreach ($bookedDates as $bookedDate) {
                            if ($start_date <= $bookedDate['end_date'] && $end_date >= $bookedDate['start_date']) {
                                $error = "Les dates sélectionnées sont déjà réservées !";
                                exit;
                            }
                        }
                        if ($error == "") {
                            $userId = $_SESSION["user"]["id"];
                            addBooking($start_date, $end_date, $userId, $rentingId);
                            header('Location: /');
                            exit;
                        }
                    }
                }
            }
        } 

        $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
        $twig = new \Twig\Environment($loader);

        $renting = GetRentingWithDetails($rentingId);
        $renting['encoded_picture'] = base64_encode($renting['picture']);

        $template = $twig->load('pages/renting.html.twig');

        echo $template->display([
            'renting' => $renting,
            'user_connect' => isset($_SESSION["user"]),
            'current_date' => $currentDate,
            'error' => $error,
            'booked_dates' => $bookedDatesDisplay,
            'favorite_message' => $favorite_message,
        ]);
    }
?>