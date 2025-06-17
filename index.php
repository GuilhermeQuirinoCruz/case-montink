<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// require_once __DIR__ . "/src/model/order.php";

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

<body class="index">
    <div class="container-fluid px-4">
        <div id="row">
            <div class="column">
                <div id="modalContainer"></div>
            </div>
        </div>

        <h1>Sistema ERP</h1>
        <div class="row justify-content-between">
            <div class="col-8 bg-warning mx-2">
                <div id="productForm" class="row mx-2">
                    <?php require_once "./src/view/product-form.php" ?>
                </div>

                <div class="row border-bottom border-3 border-dark mt-5 mb-5 mx-2 rounded"></div>

                <div id="productList" class="row mx-2">
                    <?php require_once "./src/view/product-list.php" ?>
                </div>
            </div>
            <div class="col bg-danger">
                <div class="product-cart sticky-top" id="productCart">
                    <?php require_once "./src/view/product-cart.php" ?>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </div>
    <br>
</body>

</html>