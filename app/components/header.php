<header id="desktop-header">
    <!-- toggle switch to open the mobile menu, onyl visible on phones and tablets -->
    <div class="mobile-header container flex flex-row flex-space-between" id="mobile-toggle">
        <button id="mobile-menu-toggle" aria-label="Toggle menu" style="background: none; border: none;">
            <img src="/estore/assets/svg/menu.svg" alt="Menu Icon" width="30" height="30">
        </button>
        <a href="/estore">
            <img class="logo" src="/estore/assets/logo/estore-logo-light.png" alt="Estore Logo" width="80" height="80">
        </a>
    </div>

    <!-- Sidebar Menu -->
    <div id="mobile-sidebar" class="mobile-sidebar">
        <button id="mobile-menu-close" class="close-button" aria-label="Close menu">✕</button>
        <nav class="mobile-nav-links">
            <ul class="flex flex-col" style="gap: 1.5rem;">
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/shop">Products</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/cart">🛒 Cart</a></li>
                <li><a href="/login">👤 Login</a></li>
            </ul>
        </nav>
    </div>

    <!-- Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>




    <!-- full desktop only menu -->
    <div class="flex flex-row flex-space-between container" id="desktop-only">
        <div class="flex flex-col">
            <a href="/estore">
                <img class="logo" src="/estore/assets/logo/estore-logo-light.png" alt="Estore Logo - Transparent"
                    width="100" height="100">
            </a>
        </div>
        <nav class="flex flex-col">
            <ul>
                <li><a class="hover-underline-animation left" href="/">Home</a></li>
                <li><a class="hover-underline-animation left" href="/about">About</a></li>
                <li><a class="hover-underline-animation left" href="/shop">shop</a></li>
                <li><a class="hover-underline-animation left" href="/contact">Contact</a></li>
            </ul>
        </nav>

        <!-- show cart and user profile icon only if the user is signed in, otherwise show a login text, handled in app.js -->

        <nav id="desktop-header-profile-login">
            <a class="hover-underline-animation left" href="/estore/login">Login</a>
        </nav>
        <!-- only shows if the user is signed in -->
        <div class="flex flex-row flex-space-between hidden" id="desktop-header-profile-icons">
            <a class="hover-underline-animation left" href="/cart">
                <img class="cart-icon icon" src="/estore/assets/svg/cart.svg" alt="Cart Icon" width="30" height="30">
            </a>
            <a class="hover-underline-animation left" href="/login">
                <img class="user-icon icon" src="/estore/assets/svg/user.svg" alt="User Icon" width="30" height="30">
            </a>
        </div>
    </div>
</header>