<?php require_once $BASE_PATH . "/controller/utils.php"; ?>
<?php require_once $BASE_PATH . "/view/template/config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<?php require_once $BASE_PATH . "/view/template/head.php"; ?>

<body>
    <div class="container p-0">
        <?php require_once $BASE_PATH . "/view/template/navbar.php"; ?>
        <?php require_once $BASE_PATH . "/view/template/modal-container.php"; ?>

        <div class="row mb-4">
            <div class="col text-bg-light rounded p-3 d-flex justify-content-center">
                <h1>Lista de Pedidos</h1>
            </div>
        </div>

        <div class="row">
            <div class="col text-bg-light rounded p-3 d-flex justify-content-center">
                <div class="table-responsive rounded">
                    <div class="overflow-scroll" style="max-height: 20rem;">
                        <table class="table table-striped table-hover table-product-list">
                            <thead>
                                <tr class="align-middle">
                                    <th>ID</th>
                                    <th>Valor (R$)</th>
                                    <th>Data</th>
                                    <th>Endereço</th>
                                    <th>
                                        <div class="d-flex justify-content-center">
                                            Excluir
                                        </div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="table-group-divider">
                                <?php foreach ($orders as $order): ?>
                                    <tr class="align-middle">
                                        <td><?php echo $order->getId() ?></td>
                                        <td><?php echo formatPrice($order->getTotal()) ?></td>
                                        <td><?php echo $order->getAddress() ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <?php echo "<button class='btn btn-danger' name='btnDeleteOrder'
            orderid=" . $order->getId() . ">🗑️</button>" ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once $BASE_PATH . "/view/template/footer.php"; ?>
    </div>
</body>

</html>