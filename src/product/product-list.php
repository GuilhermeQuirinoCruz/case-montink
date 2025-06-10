<?php
require __DIR__ . "/product.php";
$pdo = require __DIR__ . "/../db.php";

$getProductFromData = function ($data): Product {
    return new Product(
        $data["id"],
        $data["nome"],
        floatval($data["preco"]),
        $data["variacoes"]
    );
};

if ($pdo) {
    $stmt = $pdo->query("SELECT * FROM produto");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = array_map($getProductFromData, $data);
}
?>

<h1>Produtos Cadastrados</h1>
<?php
if (!$products) {
    echo "<h2>Não há produtos cadastrados</h2>";
    return;
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço (R$)</th>
        <th>Variações</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product->getId() ?></td>
            <td><?php echo $product->getName() ?></td>
            <td><?php echo $product->getPrice() ?></td>
            <td><?php echo $product->getVariations() ?></td>
        </tr>
    <?php endforeach; ?>
</table>