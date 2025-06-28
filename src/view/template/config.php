<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["productCart"])) {
    $_SESSION["productCart"] = [];
    $_SESSION["productCartTotal"] = 0;
    $_SESSION["orderShipping"] = 0;
}

switch ($_SERVER["SCRIPT_NAME"]) {
    case "/product.php":
        $CURRENT_PAGE = "product";
        $PAGE_TITLE = "Produtos";
        break;
    case "/order.php":
        $CURRENT_PAGE = "order";
        $PAGE_TITLE = "Pedidos";
        break;
    default:
        $CURRENT_PAGE = "index";
        $PAGE_TITLE = "Página Principal";
}
