<?php 

function CoreRoute() {
    $request = $_SERVER['REQUEST_URI'];
    $viewDir = '/Views/';

    switch ($request) {
        case '':
        case '/':
            require __DIR__ . $viewDir . 'home.php';
            break;
    
        case '/user':
            require __DIR__ . $viewDir . 'user.php';
            break;
    
        case '/inscription':
            require __DIR__ . $viewDir . 'InscriptionPage.php';
            break;
    
        default:
            http_response_code(404);
            require __DIR__ . $viewDir . '404.php';
    }
}


?>