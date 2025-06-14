<?php
require_once __DIR__ . "/../model/product.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    switch ($_POST["action"]) {
        case "add":
            addProductToCart($_POST["productId"]);
            break;
        case "remove":
            removeProductFromCart($_POST["productId"]);
            break;
    }
}

function addProductToCart($id)
{
    if (isset($_SESSION["product-cart"][$id])) {
        return;
    }

    $_SESSION["product-cart"][$id] = array(
        "product" => serialize(getProductById($id)),
        "amount" => 1
    );
}

function removeProductFromCart($id) {
    if (!isset($_SESSION["product-cart"][$id])) {
        return;
    }

    unset($_SESSION["product-cart"][$id]);
}