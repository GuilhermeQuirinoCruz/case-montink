<div class="product-cart row sticky-top bg-info" style="top: 10px">
    <script type="module" language="javascript" src="/src/view/js/product-cart.js">
    </script>

    <?php
    require_once __DIR__ . "/../controller/product-cart-controller.php";
    ?>

    <style>
        <?php require_once __DIR__ . "/css/product-cart.css"; ?>
    </style>

    <div class="col">
        <div class="product-cart-title row">
            <div class="col">
                <h2>Carrinho 🛒</h2>
            </div>
        </div>

        <div class="product-cart-list row overflow-scroll">
            <div class="col p-2 mx-3">
                <?php
                if (count($_SESSION["product-cart"]) == 0) {
                    echo "Carrinho vazio";
                } else {
                    foreach ($_SESSION["product-cart"] as $productId => $productData):
                        $product = unserialize($productData["product"]);
                ?>
                        <div class="row rounded bg-white align-items-center p-1 mb-2">
                            <div class="col-6">
                                <?php echo $product->getName() ?>
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="number"
                                    name="productCartAmount"
                                    min=1 max=<?php echo $product->getStock(); ?>
                                    value=<?php echo $productData["amount"]; ?>>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <button class="btn btn-danger" name="btnRemoveFromCart"
                                    productid=<?php echo $productId; ?>> X </button>
                            </div>
                        </div>
                <?php endforeach;
                }
                ?>
            </div>
        </div>

        <div class="product-cart-checkout row">
            <div class="col p-2 d-flex justify-content-end">
                <button class="btn btn-success">Comprar</button>
            </div>
        </div>
    </div>
</div>