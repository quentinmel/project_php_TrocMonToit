<?php

require_once('App/Models/InitDatabase.php');

initDatabase();

$request = $_SERVER['REQUEST_URI'];
$viewDir = '/App/Views/';

switch ($request) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/user':
        require __DIR__ . $viewDir . 'user.php';
        break;

    case '/contact':
        require __DIR__ . $viewDir . 'contact.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}