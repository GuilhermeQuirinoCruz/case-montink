<?php
$TITLES = array(
    "product" => "Produtos",
    "order" => "Pedidos",
    "coupon" => "Cupons",
);
?>

<nav class="navbar navbar-expand text-bg-light rounded my-3 mx-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <h1 class="display-4">
                <strong>💡 Sistema ERP</strong>
            </h1>
        </a>

        <div class="navbar-nav">
            <?php foreach ($TITLES as $page => $title): ?>
                <a class="nav-link <?php if ($CURRENT_PAGE == $page) {
                                        echo "active";
                                    } ?>"
                    href=<?php echo $page ?>><?php echo $title ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<!-- <script type="application/javascript" src="/src/view/js/navbar.js"> -->
<script type="module" src="/src/view/js/navbar.js">
</script>