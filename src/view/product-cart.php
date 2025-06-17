<div class="row bg-info">
    <script type="module" language="javascript" src="/src/view/js/product-cart.js">
    </script>

    <?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    require_once __DIR__ . "/../controller/product-cart-controller.php";

    function formatPrice($price)
    {
        return number_format($price, 2);
    }
    ?>

    <style>
        <?php require_once __DIR__ . "/css/product-cart.css"; ?>
    </style>

    <div class="col">
        <div class="product-cart-title row">
            <div class="col d-flex justify-content-center align-items-center">
                <h2>Carrinho 🛒</h2>
            </div>
        </div>

        <?php
        if (count($_SESSION["productCart"]) == 0) {
            echo "<div class='row'>";

            echo "<div class='col d-flex flex-column align-items-center text-center p-2 mx-3'>";
            echo "<h5>Carrinho vazio</h5>";
            echo "Adicione produtos ao carrinho para realizar uma compra";
            echo "</div>";

            echo "</div>";

            echo "</div>";
            echo "</div>";
            return;
        } ?>
        <div class="product-cart-list row overflow-scroll">
            <div class="col p-2 mx-2">
                <?php
                foreach ($_SESSION["productCart"] as $productId => $product): ?>
                    <div class="row rounded bg-white align-items-center p-1 mb-1">
                        <div class="col-5">
                            <?php echo $product["name"] ?>
                        </div>
                        <div class="col-3">
                            <?php echo "R$" . formatPrice($product["price"]) ?>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="number"
                                name="productCartAmount"
                                min=1 max=<?php echo $product["stock"]; ?>
                                value=<?php echo $product["amount"]; ?>
                                productid=<?php echo $productId; ?>>
                        </div>
                        <div class="col-1 d-flex justify-content-center">
                            <button class="btn btn-danger btn-sm" name="btnRemoveFromCart"
                                productid=<?php echo $productId; ?>>&times;</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="product-cart-checkout row">
            <div class="col p-2 d-flex justify-content-start align-items-center text-center">
                <?php echo "Subtotal: R$" . formatPrice($_SESSION["productCartTotal"]); ?>
            </div>

            <div class="col p-2 d-flex justify-content-end align-items-center text-center">
                <?php
                echo "Frete: ";
                $shipping = $_SESSION["orderShipping"];
                if ($shipping == 0) {
                    echo "Grátis";
                } else {
                    echo "R$" . formatPrice($shipping);
                } ?>
            </div>
        </div>

        <div class="row">
            <div class="col p-2">
                CEP (apenas números):
                <input class="form-control" type="number"
                    name="zipCode" id="zipCode"
                    minlength="8" maxlength="8"
                    placeholder="00000-000">
            </div>
        </div>

        <div class="product-cart-checkout row">
            <div class="col p-2 d-flex justify-content-end">
                <button class="btn btn-success" id="btnCheckout">Comprar</button>
            </div>
        </div>
    </div>
</div>