<script type="module" language="javascript" src="/src/view/js/product-list.js">
</script>

<style>
    <?php require_once __DIR__ . "/css/product-list.css"; ?>
</style>

<h1>Produtos Cadastrados</h1>

<?php
require_once __DIR__ . "/../controller/product-list-controller.php";

if (count($products) == 0) {
    echo "<h2>Não há produtos cadastrados</h2>";
    return;
}
?>

<div class="table-responsive">
    <div class="overflow-scroll" style="height: 25rem;">
        <table class="table table-striped table-hover table-product-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço (R$)</th>
                    <th>Variações</th>
                    <th>Estoque</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                    <th>Comprar</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                <?php foreach ($products as $product): ?>
                    <tr class="align-middle">
                        <td><?php echo $product->getId() ?></td>
                        <td><?php echo $product->getName() ?></td>
                        <td><?php echo $product->getPrice() ?></td>
                        <td><?php echo $product->getVariations() ?></td>
                        <td><?php echo $product->getStock() ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <?php echo "<button class='btn btn-warning' name='btnUpdateProduct'
                productid=" . $product->getId() . ">✏️</button>" ?>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <?php echo "<button class='btn btn-danger' name='btnDeleteProduct'
                productid=" . $product->getId() . ">🗑️</button>" ?>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <?php echo "<button class='btn btn-success' name='btnAddToCart'
                            productid=" . $product->getId() . ">+</button>" ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>