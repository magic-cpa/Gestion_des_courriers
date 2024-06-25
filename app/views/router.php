<?php

$request_uri = $_SERVER['REQUEST_URI'];


switch ($request_uri) {
    case '/':
        // Example: Include a default view or controller
        require_once __DIR__ . '/dashboard/index.php';
        break;
    case '/login':
        require_once __DIR__ . '/auth/login.php'; 
        break;
    case '/signup':
        require_once __DIR__ . '/auth/signup.php';
        break;
    case '/forgot-password': 
        require_once __DIR__ . '/auth/forgotPassword.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}