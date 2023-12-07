<?php 
require_once("App/Models/queries.php");

function loadProfilePage() {

    session_start();
    $user_connect = isset($_SESSION["user"]);
    if (!$user_connect) {
        header("Location: /login");
        exit;
    }

    $bookings = GetBookingsByUserIdWithoutFormat($_SESSION["user"]["id"]);
    $reviews = GetReviewsByUserId($_SESSION["user"]["id"]);
    $favorite = GetFavoritesByUserId($_SESSION["user"]["id"]);

    foreach ($bookings as &$booking) {
        $start_date = new DateTime($booking["start_date"]);
        $end_date = new DateTime($booking["end_date"]);
        
        $price = $booking["renting_price"];

        $interval = $start_date->diff($end_date);
        $num_days = $interval->days;
        
        $pricetotal = $price * $num_days;

        $booking["price_total"] = $pricetotal;
    }
    unset($booking);

    foreach ($reviews as &$review) {
        $review["renting_id"] = GetRentingWithDetailsByName($review["renting_name"])["id"];
    }

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/profile.html.twig');

    echo $template->render([
        'users' => GetUserByEmail($_SESSION["user"]["email"]),
        'bookings' => $bookings,
        'favorites' => $favorite,
        'reviews' => $reviews,
    ]);
}

?>