<?php
require_once $BASE_PATH . "/controller/utils.php";
require_once $BASE_PATH . "/model/product.php";

$products = getAllProducts();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    switch ($_POST['action']) {
        case "delete":
            echo handleDeleteProduct();
            break;
    }
}

function handleDeleteProduct()
{
    $status = deleteProduct(intval($_POST["productId"]));
    if (!$status->getSuccess()) {
        echo getStatusAsJSON(false, "Erro", $status->getMessage());
    }

    return getStatusAsJSON(true, "Operação bem-sucedida", "Produto removido");
}
