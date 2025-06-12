<?php
require_once __DIR__ . "/../model/product.php";
require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    switch ($_POST["action"]) {
        case "insert":
            insertProduct();
            break;
        case "update":
            updateProduct();
            break;
    }
}

function insertProduct()
{
    if (empty($_POST["product"])) {
        echo "Dados inválidos";
        return;
    }

    $product = new Product(
        0,
        htmlspecialchars($_POST["product"]["name"]),
        floatval(htmlspecialchars($_POST["product"]["price"])),
        htmlspecialchars($_POST["product"]["variations"]),
        intval(htmlspecialchars($_POST["product"]["stock"])),
    );

    $pdo = getPdo();
    $query = "
    START TRANSACTION;

    INSERT INTO produto (nome, preco, variacoes)
    VALUES (:nome, :preco, :variacoes);

    INSERT INTO estoque (id_produto, quantidade)
    SELECT LAST_INSERT_ID(), :quantidade;

    COMMIT;";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ":nome" => $product->getName(),
        ":preco" => $product->getPrice(),
        ":variacoes" => $product->getVariations(),
        ":quantidade" => $product->getStock()
    ]);
}

function getProductById($id)
{
    $pdo = getPdo();
    $query = "
    SELECT p.id, p.nome, p.preco, p.variacoes, e.quantidade
    FROM produto AS p
    JOIN estoque AS e ON p.id = e.id_produto
    WHERE p.id = :id_produto";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ":id_produto" => $id,
    ]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $product = getProductFromData($data);

    return $product;
}

function updateProduct() {
    if (empty($_POST["product"])) {
        echo "Dados inválidos";
        return;
    }

    $product = new Product(
        intval($_POST["product"]["id"]),
        htmlspecialchars($_POST["product"]["name"]),
        floatval(htmlspecialchars($_POST["product"]["price"])),
        htmlspecialchars($_POST["product"]["variations"]),
        intval(htmlspecialchars($_POST["product"]["stock"])),
    );

    $pdo = getPdo();
    $query = "
    START TRANSACTION;

    UPDATE produto
    SET nome = :nome, preco = :preco, variacoes = :variacoes
    WHERE id = :id_produto;

    UPDATE estoque
    SET quantidade = :quantidade
    WHERE id_produto = :id_produto;

    COMMIT;";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ":id_produto" => $product->getId(),
        ":nome" => $product->getName(),
        ":preco" => $product->getPrice(),
        ":variacoes" => $product->getVariations(),
        ":quantidade" => $product->getStock()
    ]);
}
