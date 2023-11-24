<?php
function loadAdminModifyLogement() {
    require_once("App/Models/injection.php");
    require_once("App/Models/queries.php");

    session_start();

    $loader = new \Twig\Loader\FilesystemLoader('App/Views/');
    $twig = new \Twig\Environment($loader);

    $template = $twig->load('pages/admin_modify_logement.html.twig');

    echo $template->display([
        'rentings' => GetRenting(),
        'services' => GetServices(),
        'equipements' => GetEquipements(),
        'user_connect' => isset($_SESSION["user"]),
    ]);
}
?>
