<?php
require_once __DIR__ . "/../controller/db.php";

class Product
{
    private $id;
    private $name;
    private $price;
    private $variations;
    private $stock;

    function __construct($id, $name, $price, $variations, $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->variations = $variations;
        $this->stock = $stock;
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function getVariations()
    {
        return $this->variations;
    }

    function setVariations($variations)
    {
        $this->variations = $variations;
    }

    function getStock()
    {
        return $this->stock;
    }

    function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function toJson()
    {
        return get_object_vars($this);
    }
}

function getProductFromData($data): Product
{
    return new Product(
        $data["id"],
        $data["nome"],
        floatval($data["preco"]),
        $data["variacoes"],
        intval($data["quantidade"])
    );
};

function getProductFromRequest($request): Product
{
    return new Product(
        intval(htmlspecialchars($request["product"]["id"])),
        htmlspecialchars($request["product"]["name"]),
        floatval(htmlspecialchars($request["product"]["price"])),
        htmlspecialchars($request["product"]["variations"]),
        intval(htmlspecialchars($request["product"]["stock"])),
    );
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

function getAllProducts(): array
{
    try {
        $pdo = getPdo();
        $query = "
        SELECT p.id, p.nome, p.preco, p.variacoes, e.quantidade
        FROM produto AS p
        JOIN estoque as e
        ON p.id = e.id_produto;";

        $stmt = $pdo->query($query);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map("getProductFromData", $data);
    } catch (Exception $e) {
        echo $e;
        return [];
    }
}

function insertProduct($product)
{
    try {
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
    } catch (Exception $e) {
        echo $e;
    }
}

function updateProduct($product)
{
    try {
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
    } catch (Exception $e) {
        echo $e;
    }
}

function deleteProduct($id)
{
    try {
        $pdo = getPdo();

        $query = "
        DELETE FROM estoque
        WHERE id_produto = :id_produto;

        DELETE FROM produto
        WHERE id = :id_produto;";

        $stmt = $pdo->prepare($query);

        $stmt->execute([
            ":id_produto" => $id
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}

function updateProductStock($id, $stock) {
    try {
        $pdo = getPdo();

        $query = "
        UPDATE estoque
        SET quantidade = :quantidade
        WHERE id_produto = :id_produto;";

        $stmt = $pdo->prepare($query);

        $stmt->execute([
            ":id_produto" => $id,
            ":quantidade" => $stock
        ]);
    } catch (Exception $e) {
        echo $e;
    }
}