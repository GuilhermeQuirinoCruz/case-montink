<?php
require_once __DIR__ . "/../model/product.php";

$product = null;
$fill = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    switch ($_POST["action"]) {
        case "insert":
            handleProductInsert();
            break;
        case "fill":
            $product = getProductById($_POST["productId"]);
            $fill = true;
            break;
        case "update":
            handleProductUpdate();
            break;
    }
}

function handleProductInsert()
{
    if (empty($_POST["product"])) {
        echo "Dados inválidos";
        return;
    }

    $_POST["product"]["id"] = 0;
    insertProduct(getProductFromRequest($_POST));
}

function handleProductUpdate()
{
    if (empty($_POST["product"])) {
        echo "Dados inválidos";
        return;
    }

    updateProduct(getProductFromRequest($_POST));
}
