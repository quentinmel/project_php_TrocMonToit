<?php
function loadAdminModifyRenting() {
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

    $rentings = GetRentingsWithDetails();
    foreach ($rentings as &$renting) {
        $renting['encoded_picture'] = base64_encode($renting['picture']);
    }

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/admin_modify_logement.html.twig');

    echo $template->display([
        'rentings' => $rentings,
    ]);
}
?>
