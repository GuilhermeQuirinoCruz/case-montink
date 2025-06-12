<?php
require_once __DIR__ . "/../model/product.php";
require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

    switch ($_POST['action']) {
        case "delete":
            deleteProduct();
        default:
            break;
    }
}

function getProducts()
{
    $pdo = getPdo();
    if ($pdo) {
        $stmt = $pdo->query("SELECT p.id, p.nome, p.preco, p.variacoes, e.quantidade
        FROM produto AS p
        JOIN estoque as e
        ON p.id = e.id_produto");

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map("getProductFromData", $data);
    }

    return [];
}

function deleteProduct()
{
    $pdo = getPdo();
    if ($pdo) {
        try {
            $id = intval(htmlspecialchars($_POST["productId"]));
    
            $stmt = $pdo->prepare(
                "DELETE FROM estoque
                WHERE id_produto = :id_produto;
    
                DELETE FROM produto
                WHERE id = :id_produto;
            "
            );
    
            $stmt->execute([
                ":id_produto" => $id
            ]);

            echo true;
        } catch (Exception $e) {
            echo false;
        }
    }
}
