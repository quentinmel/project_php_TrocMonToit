<?php 

function CoreRoute() {
    $request = $_SERVER['REQUEST_URI'];
    $viewDir = '/Views/';

    require_once 'vendor/autoload.php';

    switch ($request) {
        case '':
        case '/':
            require_once("App/Controllers/loadHomePage.php");
            loadHomePage();
            break;
    
        case '/profile':
            require __DIR__ . $viewDir . 'profile.php';
            break;
    
        case '/signin':
            require __DIR__ . $viewDir . 'signinPage.php';
            break;

        case '/signinfinish':
            require_once("App/Controllers/signin.php");
            addUsertoDB($_POST["lastname"], $_POST["firstname"], $_POST["phone"], $_POST["email"], $_POST["password"], $_POST["password_confirm"]);
            break;

        case '/login':
            require __DIR__ . $viewDir . 'loginPage.php';
            break;
    
        case '/loginfinish':
            require_once("App/Controllers/login.php");
            login($_POST["email"], $_POST["password"]);
            break;

        default:
            http_response_code(404);
            require_once("App/Controllers/load404Page.php");
            load404Page();
    }
}


?>