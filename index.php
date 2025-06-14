<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["product-cart"])) {
    $_SESSION["product-cart"] = [];
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
    <div class="container">
        <h1>Sistema ERP</h1>
        <div class="row justify-content-between">
            <div class="col-8 bg-warning mx-2">
                <?php require_once "./src/view/product-form.php" ?>
                <?php require_once "./src/view/product-list.php" ?>
            </div>
            <div id="product-cart" class="col bg-danger">
                <?php require_once "./src/view/product-cart.php" ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </div>
    <br>
</body>

</html>