<?php
require_once __DIR__ . "/../controller/product-form-controller.php";
require_once __DIR__ . "/../model/product.php";
?>

<h1>Produtos</h1>

<form action="" method="POST" id="formProduct">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name">
    <br>

    <label for="price">Preço (R$):</label>
    <input type="number" name="price" id="price">
    <br>

    <label for="variations">Variações:</label>
    <input type="text" name="variations" id="variations">
    <br>

    <label for="stock">Estoque:</label>
    <input type="number" name="stock" id="stock">
    <br>

    <button type="submit" id="btnSubmitFormProduct">Cadastrar</button>
</form>

<script type="text/javascript" language="javascript" src="product-form.js"></script>