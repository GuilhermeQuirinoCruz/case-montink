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

<div class="product-cart-title row rounded text-bg-light">
    <div class="col d-flex justify-content-center align-items-center py-2">
        <h2>Carrinho 🛒</h2>
    </div>
</div>

<?php
if (count($_SESSION["productCart"]) == 0) {
    echo "<div class='product-cart-empty row rounded text-bg-secondary'>";

    echo "<div class='col d-flex flex-column align-items-center justify-content-center gap-3 text-center p-2 mx-3'>";
    echo "<h4>Carrinho vazio</h4>";
    echo "Adicione produtos ao carrinho para realizar uma compra";
    echo "</div>";

    echo "</div>";

    echo "</div>";
    echo "</div>";
    return;
} ?>

<div class="product-cart-list row overflow-scroll text-bg-light mt-2 rounded">
    <div class="col p-3 mx-2">
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

<div class="product-cart-zipcode row text-bg-light mt-2 rounded">
    <div class="col p-2">
        <label class='form-label' for="zipCode">CEP (apenas números):</label>
        <input class="form-control" type="text"
            name="zipCode" id="zipCode"
            placeholder="00000-000">
    </div>
</div>

<div class="product-cart-pricing row text-bg-light mt-2 rounded">
    <div class="col p-2 d-flex justify-content-start align-items-center">
        Subtotal: R$<?php echo formatPrice($_SESSION["productCartTotal"]) ?>
    </div>

    <div class="col p-2 d-flex justify-content-end align-items-center">
        <?php
        echo "Frete: ";
        $shipping = $_SESSION["orderShipping"];
        if ($shipping == 0) {
            echo "Grátis";
        } else {
            echo "R$" . formatPrice($shipping);
        }
        ?>
    </div>
</div>

<div class="product-cart-checkout row mt-2">
    <div class="col d-flex justify-content-end p-0">
        <button class="btn text-bg-light" id="btnCheckout">Comprar</button>
    </div>
</div>