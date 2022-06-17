<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/cms">CMS</a>
        </li>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>
            <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
            <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        </li>
        <section class="dropdown">
                    <li class="nav-item"><a><img src="<?php echo URLROOT . '/public/img/icons/shopping-basket.png' ?>" alt="cart-icon" class="icon__cart"></a></li>
                    <section class="dropdown-content">
                        <a href="<?php echo URLROOT; ?>/Pages/addTocart" class="dropdown-button">View cart</a>
                    </section>
        </section>
    </ul>
</nav>