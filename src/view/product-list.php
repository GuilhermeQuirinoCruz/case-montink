<script type="module" language="javascript" src="/src/view/js/product-list.js">
</script>

<h1>Produtos Cadastrados</h1>

<?php
require_once __DIR__ . "/../controller/product-list-controller.php";

$products = getProducts();
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
        <th>Estoque</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product->getId() ?></td>
            <td><?php echo $product->getName() ?></td>
            <td><?php echo $product->getPrice() ?></td>
            <td><?php echo $product->getVariations() ?></td>
            <td><?php echo $product->getStock() ?></td>
            <td>
                <?php echo "<button name='btnUpdateProduct'
                productid=" . $product->getId() . ">
                    ✏️
                </button>"
                ?>
            </td>
            <td>
                <?php echo "<button name='btnDeleteProduct'
                productid=" . $product->getId() . ">
                    🗑️
                </button>"
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>