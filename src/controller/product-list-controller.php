<?php
require_once __DIR__ . "/../model/product.php";

$products = getAllProducts();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    switch ($_POST['action']) {
        case "delete":
            handleDeleteProduct();
            break;
    }
}

function handleDeleteProduct()
{
    deleteProduct(intval(htmlspecialchars($_POST["productId"])));
}
