<?php
require_once __DIR__ . "/../model/product.php";
require_once __DIR__ . "/../model/operation-status.php";
require_once __DIR__ . "/utils.php";

$product = null;
$fill = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    if ($_POST["action"] == "fill") {
        $product = getProductById($_POST["productId"]);
        $fill = true;
        return;
    }

    $product = getProductFromRequest($_POST);
    if (!$product) {
        echo getStatusAsJSON(false, "Erro", "Produto vazio");
        return;
    }

    $message = getInvalidProductDataMessage($product);
    if (strlen($message) != 0) {
        echo getStatusAsJSON(false, "Informações incorretas", $message);
        return;
    }

    $status = null;
    switch ($_POST["action"]) {
        case "insert":
            $status = handleProductInsert($product);
            break;
        case "update":
            $status = handleProductUpdate($product);
            break;
    }

    echo $status;
}

function getServerErrorMessage($status)
{
    return getStatusAsJSON(false, "Erro", $status->getMessage());
}

function getSuccessJSON($message)
{
    return getStatusAsJSON(true, "Operação bem sucedida", $message);
}

function handleProductInsert($product)
{
    $product->setId(0);
    $status = insertProduct($product);
    if (!$status->getSuccess()) {
        return getStatusAsJSON(false, "Erro", $status->getMessage());
    }

    return getSuccessJSON("Novo produto cadastrado: <strong>" . $product->getName() . "</strong>");
}

function handleProductUpdate($product)
{
    $status = updateProduct($product);
    if (!$status->getSuccess()) {
        return getStatusAsJSON(false, "Erro", $status->getMessage());
    }

    return getSuccessJSON("Produto editado com sucesso");
}
