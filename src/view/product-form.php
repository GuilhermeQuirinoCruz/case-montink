<script type="module" language="javascript" src="/src/view/js/product-form.js">
</script>

<?php
require_once __DIR__ . "/../controller/product-form-controller.php";
?>

<div class="row mx-1 py-3">
    <div class="col">
        <?php
        if ($product) {
            echo "
            <h1 class='fw-bold'>Editar produto:</h1>" .
                "<h2>" . $product->getName() . "</h2>";
        } else {
            echo "
            <h1>Cadastrar novo produto</h1>";
        }
        ?>
    </div>
</div>

<div class="row mx-3">
    <div class="col rounded p-2 mb-4">
        <form id="formProduct" action="" method="POST">
            <?php
            if ($product) {
                echo "<label for='productId' class='form-label'>Id:</label>
            <input class='form-control' type='number' name='productId' id='productId'
            value=" . $product->getId() . " disabled>
            <br>";
            }
            ?>

            <div class="mb-3">
                <label class='form-label' for="productName">Nome:</label>
                <input class="form-control" type="text"
                    name="productName" id="productName"
                    value="<?php if ($product) {
                                echo $product->getName();
                            } ?>"
                    required
                    placeholder="Nome do produto">
            </div>

            <div class="mb-3">
                <label class='form-label' for="productPrice">Preço (R$):</label>
                <input class="form-control" type="text"
                    name="productPrice" id="productPrice"
                    value=<?php echo $product ? $product->getPrice() : "0"; ?>
                    required>
            </div>

            <div class="mb-3">
                <label class='form-label' for="productVariations">Variações:</label>
                <textarea class="form-control" type="textarea" rows=2
                    style="white-space: pre-wrap;" ;
                    name="productVariations" id="productVariations"
                    placeholder="Variações do produto"><?php if ($product) {
                                                            echo $product->getVariations();
                                                        } ?></textarea>
            </div>

            <div class="mb-3">
                <label class='form-label' for="productStock">Estoque:</label>
                <input class="form-control" type="text"
                    name="productStock" id="productStock"
                    value=<?php echo $product ? $product->getStock() : "0"; ?>
                    required>
            </div>

            <div class="row justify-content-end">
                <?php
                if ($fill) {
                    echo "
            <div class='col-sm-auto'>
            <button class='btn btn-danger' id='btnCancel'>Cancelar</button>
            </div>";

                    echo "
            <div class='col-sm-auto'>
            <button class='btn btn-warning' id='btnUpdate'>Editar</button>
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
</div>