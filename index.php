<?php

session_start();

require_once 'app/models/ProductModel.php';

$url = $_GET['url'] ?? '';

if ($url == '') {

    header('Location: /NguyenNhatTruong_2393/Product/list');

    exit();
}

$url = rtrim($url, '/');

$url = filter_var($url, FILTER_SANITIZE_URL);

$url = explode('/', $url);

$controllerName = isset($url[0]) && $url[0] != ''
    ? ucfirst($url[0]) . 'Controller'
    : 'DefaultController';

$action = isset($url[1]) && $url[1] != ''
    ? $url[1]
    : 'index';

$controllerPath = 'app/controllers/' . $controllerName . '.php';

if (!file_exists($controllerPath)) {

    die('Controller not found');
}

require_once $controllerPath;

$controller = new $controllerName();

if (!method_exists($controller, $action)) {

    die('Action not found');
}

call_user_func_array(
    [$controller, $action],
    array_slice($url, 2)
);