<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["productCart"])) {
    $_SESSION["productCart"] = [];
    $_SESSION["productCartTotal"] = 0;
    $_SESSION["orderShipping"] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="./src/view/css/index.css" rel="stylesheet">

    <link rel="icon" href="data:,">
    <title>Sistema ERP</title>
</head>

<body class="index mb-4">
    <div class="container p-0">
        <div id="row">
            <div class="column">
                <div id="modalContainer"></div>
            </div>
        </div>

        <div class="row px-2 py-3">
            <div class="column m-3">
                <div class="d-flex flex-column justify-content-center">
                    <h1 class="display-4 text-white">
                        <strong>Sistema ERP</strong>
                    </h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-8 pe-5">
                <div class="row">
                    <div id="productForm" class="col text-bg-light rounded">
                        <?php require_once "./src/view/product-form.php" ?>
                    </div>
                </div>

                <div class="row border-bottom border-3 border-dark my-4 mx-2 rounded"></div>

                <div class="row">
                    <div id="productList" class="col text-bg-light rounded">
                        <?php require_once "./src/view/product-list.php" ?>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="product-cart sticky-top" id="productCart">
                    <?php require_once "./src/view/product-cart.php" ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </div>
</body>

</html>