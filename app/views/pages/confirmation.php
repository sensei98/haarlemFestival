<header>
    <?php require APPROOT . '/views/includes/head.php';
    unset($_SESSION["shopping_cart"]);
    ?>
</header>

<body>

    <section class="progressbar-3-container">
        <ul class="progressbar-3">
            <li class="#">
                <a href="#">shopping basket</a>
            </li>
            <li class="#">
                <a href="#">delivery </a>
            </li>
            <li class="#">
                <a href="">payment</a>
            </li>
            <li class="active">
                <a href="<?php echo URLROOT; ?>/Pages/confirmation"> confirmation</a>
            </li>
        </ul>
    </section>
    <section class="emptyLabel">
        Thanks for shopping with us. Your ticket has been mailed to you.
    </section>
    <section class='btn-continue-container'><a class='btn-continue' href='<?php echo URLROOT; ?>/pages/index'>Continue shopping?</a></section>

</body>