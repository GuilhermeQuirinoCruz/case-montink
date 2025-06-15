<?php
require_once __DIR__ . "/../model/product.php";
require_once __DIR__ . "/../model/order.php";

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
        case "updateAmount":
            updateProductAmount($_POST["productId"], $_POST["amount"]);
            break;
        case "updateData":
            updateProductData($_POST["productId"]);
            break;
        case "checkout":
            checkout();
            break;
    }

    updateProductTotal();
}

function setProductData($id)
{
    $product = getProductById($id);
    $_SESSION["product-cart"][$id] = array(
        "name" => $product->getName(),
        "price" => $product->getPrice(),
        "stock" => $product->getStock(),
        "amount" => 1,
    );
}

function addProductToCart($id)
{
    if (isset($_SESSION["product-cart"][$id])) {
        return;
    }

    setProductData($id);
    updateProductAmount($id, 1);
}

function removeProductFromCart($id)
{
    unset($_SESSION["product-cart"][$id]);
}

function updateProductAmount($id, $amount)
{
    if (!isset($_SESSION["product-cart"][$id])) {
        return;
    }

    $_SESSION["product-cart"][$id]["amount"] = $amount;
}

function updateProductData($id)
{
    if (!isset($_SESSION["product-cart"][$id])) {
        return;
    }

    setProductData($id);
}

function updateProductTotal()
{
    $_SESSION["product-cart-total"] = 0;
    $total = 0;
    foreach ($_SESSION["product-cart"] as $product) {
        $total += $product["amount"] * $product["price"];
    }
    $_SESSION["product-cart-total"] = $total;

    $shipping = 20;
    if ($total > 52 && $total < 166.59) {
        $shipping = 15;
    } else if ($total > 200) {
        $shipping = 0;
    }

    $_SESSION["order-shipping"] = $shipping;
}

function checkout()
{
    if (count($_SESSION["product-cart"]) == 0) {
        return;
    }

    foreach ($_SESSION["product-cart"] as $productId => $product) {
        updateProductStock($productId, $product["stock"] - $product["amount"]);
    }

    $order = new Order(
        0,
        $_SESSION["product-cart-total"] + $_SESSION["order-shipping"],
        date("Y-m-d")
    );
    insertOrder($order);

    unset($_SESSION["product-cart"]);
    $_SESSION["product-cart"] = [];
    updateProductTotal();
}
