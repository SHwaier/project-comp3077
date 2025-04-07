<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/estore/api/auth/authorize.php'; ?>
<header id="desktop-header">
    <div class="flex flex-row flex-space-between container">
        <div class="flex flex-col">
            <a href="/estore"><img class="logo" src="/estore/assets/logo/estore-logo-dark.png"
                    alt="Estore Logo - Transparent" width="100" height="100"></a>
        </div>
        <nav class="flex flex-col">
            <ul>
                <li><a class="hover-underline-animation left" href="/">Home</a></li>
                <li><a class="hover-underline-animation left" href="/about">About</a></li>
                <li><a class="hover-underline-animation left" href="/products">Products</a></li>
                <li><a class="hover-underline-animation left" href="/contact">Contact</a></li>
            </ul>
        </nav>
        <?php
        $payload = authorize_request_frontend();
        if ($payload === null) {
            echo '<a class="hover-underline-animation left" href="/login">Login</a>';
        } else {
            echo '<a class="hover-underline-animation left" href="/profile">Profile</a>';
        }

        ?>
        <div class="flex flex-row flex-space-between ">
            <a class="hover-underline-animation left" href="/cart">
                <img class="cart-icon icon" src="/estore/assets/svg/cart.svg" alt="Cart Icon" width="30" height="30">
            </a>
            <a class="hover-underline-animation left" href="/login">
                <img class="user-icon icon" src="/estore/assets/svg/user.svg" alt="User Icon" width="30" height="30">
            </a>
        </div>
    </div>

</header>