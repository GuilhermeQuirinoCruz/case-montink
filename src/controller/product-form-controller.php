<?php
require_once __DIR__ . "/../model/product.php";

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

    $message = getInvalidDataMessage($product);
    if (strlen($message) != 0) {
        echo getStatusAsJSON(false, "Informações incorretas", $message);
        return;
    }

    $successMessage = "";
    switch ($_POST["action"]) {
        case "insert":
            $successMessage = handleProductInsert($product);
            break;
        case "update":
            $successMessage = handleProductUpdate($product);
            break;
    }

    echo getStatusAsJSON(true, "Operação bem-sucedida", $successMessage);
}

function getStatusAsJSON($success, $title, $message)
{
    return json_encode(array(
        "success" => $success,
        "title" => $title,
        "message" => nl2br($message)
    ));
}

function getInvalidDataMessage($product)
{
    $message = "";
    if (strlen($product->getName()) == 0) {
        $message .= "O nome não pode ser vazio\n";
    }

    if ($product->getStock() < 0) {
        $message .= "O estoque deve ser um número maior ou igual a zero\n";
    }

    if ($product->getPrice() < 0) {
        $message .= "O preço deve ser um número maior ou igual a zero";
    }

    $message = rtrim($message, "\n");

    return $message;
}

function handleProductInsert($product)
{
    $product->setId(0);
    insertProduct($product);

    return "Novo produto cadastrado: <strong>" . $product->getName() . "</strong>";
}

function handleProductUpdate($product)
{
    updateProduct($product);

    return "Produto editado com sucesso";
}
