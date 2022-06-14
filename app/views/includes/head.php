<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php
            if (isset($data['title'])) {
                echo $data['title'];
            } else {
                echo SITENAME;
            }
            ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= URLROOT . '/public/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/CMS.css">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/jazz.css' ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/homepage.css' ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/cart.css' ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/contactPage.css' ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/confirmation.css' ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="<?= URLROOT . '/public/jquery/jquery.min.js' ?>"></script>
    <script src="<?= URLROOT . '/public/js/bootstrap.js' ?>"></script>
    <script src="<?= URLROOT . '/public/js/bootstrap-multiselect.min.js' ?>"></script>
    <script src="<?= URLROOT . '/public/js/script.js' ?>"></script>
    <link rel="stylesheet" href="<?= URLROOT . '/public/css/style.css' ?>">
</head>

<body class>
    <nav class="navbar navbar-expand-lg navbar-purple">
        <section class="container-fluid">
            <a class="navbar-brand" href="<?php echo URLROOT; ?>/pages/Home">Haarlem Festival</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <section class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo URLROOT; ?>pages/Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>pages/jazzhomepage">Jazz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>#">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>#">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>pages/cms">CMS</a>
                    </li>
                    <li class="btn-login">
                        <?php if(isset($_SESSION['user_id'])) : ?>
                        <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
                        <?php else : ?>
                        <a href="<?php echo URLROOT; ?>/users/login">Login</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php
//var_dump($_SESSION);
                        ?>
                    </li>
                </ul>
                <section class="dropdown">
                    <li class="nav-item"><a><img src="<?php echo URLROOT . '/public/img/icons/shopping-basket.png' ?>"
                                alt="cart-icon" class="icon__cart"></a></li>
                    <section class="dropdown-content">
                        <a href="<?php echo URLROOT; ?>/Pages/addTocart" class="dropdown-button">View cart</a>
                    </section>
                </section>
            </section>
        </section>
    </nav>