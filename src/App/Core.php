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
            require_once("App/Controllers/loadProfilePage.php");
            loadProfilePage();
            break;
    
        case '/signin':
            require __DIR__ . $viewDir . 'signinPage.php';
            break;

        case '/signinfinish':
            require_once("App/Controllers/signin.php");
            addUsertoDB($_POST["lastname"], $_POST["firstname"], $_POST["phone"], $_POST["email"], $_POST["password"], $_POST["password_confirm"]);
            break;

        case '/login':
            require_once("App/Controllers/loadLoginPage.php");
            loadLoginPage();
            break;
    
        case '/loginfinish':
            require_once("App/Controllers/login.php");
            login($_POST["email"], $_POST["password"]);
            break;

        case '/faker':
            require_once("App/Controllers/faker.php");
            faker();
            break;

        case '/admin':
            require_once("App/Controllers/loadAdminPage.php");
            loadAdminPage();
            break;    

        case '/create_logement':
            require_once("App/Controllers/loadAdminCreateLogement.php");
            loadAdminCreateLogement();
            break;

        case '/modify_logement':
            require_once("App/Controllers/loadAdminModifyLogement.php");
            loadAdminModifyLogement();
            break;

        case '/modify_location':
            require_once("App/Controllers/loadAdminModifyLocation.php");
            loadAdminModifyLocation();
            break;
        
        case '/modify_location_finish':
            require_once("App/Controllers/modifyLocation.php");
            modifyLocation();
            break;

        case '/delete_renting':
            require_once("App/Controllers/deleteRenting.php");
            deleteRenting();
            break;

        case "/logout":
            require_once("App/Controllers/logout.php");
            logout();
            break;

        default:
            http_response_code(404);
            require_once("App/Controllers/load404Page.php");
            load404Page();
    }
}


?>