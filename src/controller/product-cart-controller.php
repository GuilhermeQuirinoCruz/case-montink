<?php
require_once __DIR__ . "/../model/product.php";
require_once __DIR__ . "/../model/order.php";
require_once __DIR__ . "/../model/operation-status.php";
require_once __DIR__ . "/utils.php";

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
            echo checkout();
            break;
    }

    updateProductCartTotal();
}

function setProductData($id)
{
    $product = getProductById($id);
    $_SESSION["productCart"][$id] = array(
        "name" => $product->getName(),
        "price" => $product->getPrice(),
        "stock" => $product->getStock(),
        "amount" => 1,
    );
}

function addProductToCart($id)
{
    if (isset($_SESSION["productCart"][$id])) {
        updateProductAmount($id, $_SESSION["productCart"][$id]["amount"] + 1);
        return;
    }

    setProductData($id);
    // updateProductAmount($id, 1);
}

function removeProductFromCart($id)
{
    unset($_SESSION["productCart"][$id]);
}

function updateProductAmount($id, $amount)
{
    if (
        !isset($_SESSION["productCart"][$id]) ||
        $amount < 0 ||
        $amount > $_SESSION["productCart"][$id]["stock"]
    ) {
        return;
    }

    $_SESSION["productCart"][$id]["amount"] = $amount;
}

function updateProductData($id)
{
    if (!isset($_SESSION["productCart"][$id])) {
        return;
    }

    $amount = $_SESSION["productCart"][$id]["amount"];
    
    setProductData($id);

    $stock = $_SESSION["productCart"][$id]["stock"];
    if ($stock <= 0) {
        removeProductFromCart($id);
        return;
    }

    updateProductAmount($id, min($stock, $amount));
}

function updateProductCartTotal()
{
    $_SESSION["productCartTotal"] = 0;
    $total = 0;

    foreach ($_SESSION["productCart"] as $product) {
        $total += $product["amount"] * $product["price"];
    }
    $_SESSION["productCartTotal"] = $total;

    $shipping = 20;
    if ($total > 52 && $total < 166.59) {
        $shipping = 15;
    } else if ($total > 200) {
        $shipping = 0;
    }

    $_SESSION["orderShipping"] = $shipping;
}

function checkout()
{
    if (count($_SESSION["productCart"]) == 0) {
        return;
    }

    foreach ($_SESSION["productCart"] as $productId => $product) {
        updateProductStock($productId, $product["stock"] - $product["amount"]);
    }

    $order = new Order(
        0,
        $_SESSION["productCartTotal"] + $_SESSION["order-shipping"],
        date("Y-m-d"),
        $_POST["address"]
    );

    $status = insertOrder($order);
    if (!$status->getSuccess()) {
        return getStatusAsJSON(false, "Erro", $status->getMessage());
    }

    unset($_SESSION["productCart"]);
    $_SESSION["productCart"] = [];

    updateProductCartTotal();

    return getStatusAsJSON(
        true,
        "Compra bem-sucedida",
        "Compra realizada com sucesso\n"
            . "Total: R$" . number_format($order->getTotal(), 2) . "\n"
            . "Data: " . $order->getdate()
    );
}
