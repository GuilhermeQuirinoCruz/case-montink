<script type="module" language="javascript" src="/src/view/js/product-list.js">
</script>

<style>
    <?php require_once __DIR__ . "/css/product-list.css"; ?>
</style>

<?php
require_once __DIR__ . "/../controller/product-list-controller.php";
require_once __DIR__ . "/../controller/utils.php";
?>

<div class="row mx-1 py-3">
    <div class="col">
        <?php
        if (count($products) == 0) {
            echo "<div class='d-flex py-4 justify-content-center'>";
            echo "<h1>Não há produtos cadastrados</h1>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            return;
        } else {
            echo "<div class='d-flex justify-content-center'>";
            echo "<h1>Lista de Produtos Cadastrados</h1>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<div class="row p-3">
    <div class="col">
        <div class="table-responsive rounded">
            <div class="overflow-scroll" style="max-height: 20rem;">
                <table class="table table-striped table-hover table-product-list">
                    <thead>
                        <tr class="align-middle">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Preço (R$)</th>
                            <th>Variações</th>
                            <th>Estoque</th>
                            <th>
                                <div class="d-flex justify-content-center">
                                    Editar
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-center">
                                    Excluir
                                </div>
                            </th>
                            <th>
                                <div class="d-flex justify-content-center">
                                    Comprar
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="table-group-divider">
                        <?php foreach ($products as $product): ?>
                            <tr class="align-middle">
                                <td><?php echo $product->getId() ?></td>
                                <td><?php echo $product->getName() ?></td>
                                <td><?php echo formatPrice($product->getPrice()) ?></td>
                                <td style="white-space: pre-wrap;" ;><?php echo $product->getVariations() ?></td>
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
                                        <?php if ($product->getStock() > 0) {
                                            echo "<button class='btn btn-success' name='btnAddToCart'
                                    productid=" . $product->getId() . ">+</button>";
                                        } else {
                                            echo "Sem estoque";
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>