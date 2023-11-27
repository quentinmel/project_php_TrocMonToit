<?php 

function loadAdminModifyLocation() {
    require_once("App/Models/injection.php");
    require_once("App/Models/queries.php");

    $renting_id = $_POST['renting_id_modify'];
    $renting = GetRentingById($renting_id);
    session_start();

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/admin_modify_location.html.twig');

    echo $template->display([
        'services' => GetServices(),
        'equipements' => GetEquipements(),
        'renting' => $renting,
        'user_connect' => isset($_SESSION["user"]),
    ]);
}
?>