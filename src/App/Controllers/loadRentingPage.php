<?php 
    function loadRentingPage($rentingId) {
        require_once 'App/Models/queries.php';
        require_once 'App/Models/injection.php';

        session_start();

        $currentDate = date("Y-m-d");
        $bookedDates = GetBookedDates($rentingId);
        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            if (!isset($_SESSION["user"])) {
                $error = "Vous devez être connecté pour réserver un logement !";
            } else {
                if ($end_date < $start_date) {
                    $error = "La date de fin doit être supérieur à la date de début !";
                } else { 
                    $userId = $_SESSION["user"]["id"];
                    addBooking( $start_date, $end_date, $userId, $rentingId);
                    header('Location: /');
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
            'booked_dates' => $bookedDates,
        ]);
    }
?>