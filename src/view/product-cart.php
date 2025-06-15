<div class="product-cart row sticky-top bg-info" style="top: 10px">
    <script type="module" language="javascript" src="/src/view/js/product-cart.js">
    </script>

    <?php
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
        if (count($_SESSION["product-cart"]) == 0) {
            echo "<div class='row'>";

            echo "<div class='col d-flex flex-column align-items-center text-center p-2 mx-3'>";
            echo "<h5>Carrinho vazio</h5>";
            echo "Adicione produtos ao carrinho para realizar uma compra";
            echo "</div>";

            echo "</div>";
        } else {
            echo "<div class='product-cart-list row overflow-scroll'>";
            echo "<div class='col p-2 mx-2'>";
            foreach ($_SESSION["product-cart"] as $productId => $product): ?>
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
                            productid=<?php echo $productId; ?>>O</button>
                    </div>
                </div>
        <?php endforeach;
            echo "</div>";
            echo "</div>";

            echo "<div class='product-cart-checkout row'>";

            echo "<div class='col p-2 d-flex justify-content-start align-items-center text-center'>";
            echo "Subtotal: R$" . formatPrice($_SESSION["product-cart-total"]);
            echo "</div>";

            echo "<div class='col p-2 d-flex justify-content-end align-items-center text-center'>";
            echo "Frete: ";
            $shipping = $_SESSION["order-shipping"];
            if ($shipping == 0) {
                echo "Grátis";
            } else {
                echo "R$" . formatPrice($shipping);
            }
            echo "</div>";

            echo "</div>";

            echo "<div class='product-cart-checkout row'>";

            echo "<div class='col p-2 d-flex justify-content-end'>";
            echo "<button class='btn btn-success' id='btnCheckout'>Comprar</button>";
            echo "</div>";

            echo "</div>";
        }
        ?>
    </div>
</div>