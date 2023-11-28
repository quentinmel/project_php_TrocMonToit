<?php 

function loadAdminModifyLocation() {
    require_once("App/Models/injection.php");
    require_once("App/Models/queries.php");

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

    $renting_id = $_POST['renting_id_modify'];

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $renting = GetRentingWithDetails($renting_id);
    $renting['encoded_picture'] = base64_encode($renting['picture']);
        

    $template = $twig->load('pages/admin_modify_location.html.twig');

    echo $template->display([
        'services' => GetServices(),
        'equipments' => GetEquipments(),
        'types' => GetTypes(),
        'renting' => $renting,
    ]);
}
?>