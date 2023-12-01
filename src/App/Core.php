<?php 

function CoreRoute() {
    $request = $_SERVER['REQUEST_URI'];
    $viewDir = '/Views/';
    $url = explode('/', $request);

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
    
        case '/signup':
            require_once("App/Controllers/loadSignupPage.php");
            loadSignupPage();
            break;

        case '/login':
            require_once("App/Controllers/loadLoginPage.php");
            loadLoginPage();
            break;

        case '/admin':
            require_once("App/Controllers/loadAdminPage.php");
            loadAdminPage();
            break;    

        case '/create_renting':
            require_once("App/Controllers/loadAdminCreateRenting.php");
            loadAdminCreateRenting();
            break;

        case '/modify_renting':
            require_once("App/Controllers/loadAdminModifyRenting.php");
            loadAdminModifyRenting();
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
        
        case '/modify_equipment':
            require_once("App/Controllers/loadAdminModifyEquipment.php");
            loadAdminModifyEquipment();
            break;

        case '/modify_service':
            require_once("App/Controllers/loadAdminModifyService.php");
            loadAdminModifyService();
            break;

        case '/modify_type':
            require_once("App/Controllers/loadAdminModifyType.php");
            loadAdminModifyType();
            break;

        case "/logout":
            require_once("App/Controllers/logout.php");
            logout();
            break;
        
        case "/renting/$url[2]":
            require_once("App/Controllers/loadRentingPage.php");
            loadRentingPage($url[2]);
            break;

        default:
            http_response_code(404);
            require_once("App/Controllers/load404Page.php");
            load404Page();
    }
}


?>