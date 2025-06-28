<?php
require_once $BASE_PATH . "/model/order.php";
require_once $BASE_PATH . "/controller/utils.php";

$orders = getAllOrders();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["action"])) {
        return;
    }

}