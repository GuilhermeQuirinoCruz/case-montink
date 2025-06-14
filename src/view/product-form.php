<div id="product-form">
    <script type="module" language="javascript" src="/src/view/js/product-form.js">
    </script>

    <?php
    require_once __DIR__ . "/../controller/product-form-controller.php";
    ?>

    <h1>Produtos</h1>

    <form class="rounded bg-light p-2" action="" method="POST" id="formProduct">
        <?php
        if ($product) {
            echo "
                <label for='productid' class='form-label'>Id:</label>
                <input class='form-control' type='number' name='productId' id='productId'
                value=" . $product->getId() . " disabled>
                <br>
                ";
        }
        ?>

        <div class="mb-3">
            <label class='form-label' for="name">Nome:</label>
            <input class="form-control" type="text"
                name="productName" id="productName"
                value=<?php if ($product) {
                            echo $product->getName();
                        } ?>>
        </div>

        <div class="mb-3">
            <label class='form-label' for="price">Preço (R$):</label>
            <input class="form-control" type="number" min=0
                name="productPrice" id="productPrice"
                value=<?php if ($product) {
                            echo $product->getPrice();
                        } ?>>
        </div>

        <div class="mb-3">
            <label class='form-label' for="variations">Variações:</label>
            <textarea class="form-control" type="textarea" rows=2
                name="productVariations" id="productVariations"><?php if ($product) {
                                                                    echo $product->getVariations();
                                                                } ?></textarea>
        </div>

        <div class="mb-3">
            <label class='form-label' for="stock">Estoque:</label>
            <input class="form-control" type="number" min=0
                name="productStock" id="productStock"
                value=<?php if ($product) {
                            echo $product->getStock();
                        } ?>>
        </div>

        <div class="row justify-content-end">
            <?php
            if ($fill) {
                echo "
                <div class='col-sm-auto'>
                <button class='btn btn-warning' id='btnUpdate'>Editar</button>
                </div>";
                echo "
                <div class='col-sm-auto'>
                <button class='btn btn-danger' id='btnCancel'>Cancelar</button>
                </div>";
            } else {
                echo "
                <div class='col-sm-auto'>
                <button class='btn btn-primary' id='btnInsert'>Cadastrar</button>
                </div>";
            }
            ?>
        </div>
    </form>
</div>