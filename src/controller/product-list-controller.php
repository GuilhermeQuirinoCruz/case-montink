<?php
require_once __DIR__ . "/../model/product.php";
$pdo = require __DIR__ . "/db.php";

$getProductFromData = function ($data): Product {
    return new Product(
        $data["id"],
        $data["nome"],
        floatval($data["preco"]),
        $data["variacoes"],
        intval($data["quantidade"])
    );
};

if ($pdo) {
    $stmt = $pdo->query("SELECT p.id, p.nome, p.preco, p.variacoes, e.quantidade
    FROM produto AS p
    JOIN estoque as e
    ON p.id = e.id_produto");

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $products = array_map($getProductFromData, $data);
}
