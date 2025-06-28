<?php
$BASE_PATH = __DIR__;

$ROUTES = array(
    "/" => "index.php",
    "/product" => "product.php",
);

$request = $_SERVER['REQUEST_URI'];
if (array_key_exists($request, $ROUTES)) {
    require_once $BASE_PATH . "/view/" . $ROUTES[$request];
    return;
}

if (str_contains($request, ".js")) {
    require_once $BASE_PATH . "/.." . $request;
}

