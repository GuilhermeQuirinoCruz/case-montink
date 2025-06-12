<div id="product-form">
    <script type="module" language="javascript" src="/src/view/js/product-form.js">
    </script>

    <?php
    require_once __DIR__ . "/../controller/product-form-controller.php";

    $product = new Product(0, "", 0, "", 0);
    $updateProduct = false;

    if (
        $_SERVER["REQUEST_METHOD"] == "POST"
        && isset($_POST["action"])
        && $_POST["action"] == "getById"
    ) {
        $product = getProductById($_POST["productId"]);
        $updateProduct = true;
    }
    ?>

    <h1>Produtos</h1>

    <form action="" method="POST" id="formProduct">
        <?php
        if ($product->getId() != 0) {
            echo "
                <label for='productid'>Id:</label>
                <input type='number' name='productid' id='productid' value=" . $product->getId() . " disabled>
                <br>
                ";
        }
        ?>

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" value=<?php echo $product->getName() ?>>
        <br>

        <label for="price">Preço (R$):</label>
        <input type="number" name="price" id="price" value=<?php echo $product->getPrice() ?>>
        <br>

        <label for="variations">Variações:</label>
        <input type="text" name="variations" id="variations" value=<?php echo $product->getVariations() ?>>
        <br>

        <label for="stock">Estoque:</label>
        <input type="number" name="stock" id="stock" value=<?php echo $product->getStock() ?>>
        <br>

        <?php
        if ($updateProduct) {
            echo "<button id='btnUpdate'>Editar</button>";
            echo "<button id='btnCancel'>Cancelar</button>";
        } else {
            echo "<button id='btnInsert'>Cadastrar</button>";
        }
        ?>
    </form>
</div>