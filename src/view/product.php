<?php require_once $BASE_PATH . "/view/template/config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<?php require_once $BASE_PATH . "/view/template/head.php"; ?>

<body class="mb-4">
    <div class="container p-0">
        <?php require_once $BASE_PATH . "/view/template/navbar.php"; ?>
        <?php require_once $BASE_PATH . "/view/template/modal-container.php"; ?>

        <div class="row justify-content-between">
            <div class="col-8 pe-5">
                <div class="row">
                    <div id="productForm" class="col text-bg-light rounded">
                        <?php require_once $BASE_PATH . "/view/product/product-form.php"; ?>
                    </div>
                </div>

                <div class="row border-bottom border-3 border-dark my-4 mx-2 rounded"></div>

                <div class="row">
                    <div id="productList" class="col text-bg-light rounded">
                        <?php require_once $BASE_PATH . "/view/product/product-list.php"; ?>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="product-cart sticky-top" id="productCart">
                    <?php require_once $BASE_PATH . "/view/product/product-cart.php"; ?>
                </div>
            </div>
        </div>

        <?php require_once $BASE_PATH . "/view/template/footer.php"; ?>
    </div>
</body>

</html>