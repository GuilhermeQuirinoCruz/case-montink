<?php
require_once __DIR__ . "/../model/product.php";
$pdo = require __DIR__ . "/db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = new Product(
        0,
        htmlspecialchars($_POST["name"]),
        floatval(htmlspecialchars($_POST["price"])),
        htmlspecialchars($_POST["variations"]),
        intval(htmlspecialchars($_POST["stock"])),
    );

    if (
        empty($_POST["name"]) ||
        empty($_POST["price"]) ||
        empty($_POST["variations"]) ||
        empty($_POST["stock"])
    ) {
        echo "Tem coisa errada aí man";
        return;
    }

    $stmt = $pdo->prepare("INSERT INTO produto (nome, preco, variacoes)
        VALUES (:nome, :preco, :variacoes)");

    $stmt->execute([
        ":nome" => $product->getName(),
        ":preco" => $product->getPrice(),
        ":variacoes" => $product->getVariations(),
    ]);

    $id_produto = intval($pdo->lastInsertId());
    $stmt = $pdo->prepare("INSERT INTO estoque (id_produto, quantidade)
        VALUES (:id_produto, :quantidade)");

    $stmt->execute([
        ":id_produto" => $id_produto,
        ":quantidade" => $product->getStock()
    ]);
} else {
    // header("Location: ../../../index.php");
    // exit();
}
