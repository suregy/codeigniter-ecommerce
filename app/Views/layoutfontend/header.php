<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <?php if (!session()->has('isLoggedIn')) : ?>
                        <div class="header__top__links">
                            <a href="<?= base_url('/auth') ?>">Sign in</a>
                            <a href="#">FAQs</a>
                        </div>
                        <?php elseif (session()->has('isLoggedIn')) : ?>
                        <div class="header__top__hover">
                            <span>My Account <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li><a class="link__saya" href="">My Profile</a></li>
                                <li><a class="link__saya" href="">My Order</a></li>
                                <li><a class="link__saya" href="Auth/logout">Logout</a></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="<?= base_url(); ?>"><img src="<?= base_url('img/logo.png') ?>" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class=""><a href="<?= base_url('/catalog/pria') ?>">Pria</a></li>
                        <li><a href="<?= base_url('/catalog/wanita') ?>">Wanita</a></li>
                        <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./about.html">About Us</a></li>
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                        <li><a href="<?= base_url('/catalog/anak') ?>">Anak</a></li>
                        <li><a href="<?= base_url('/catalog/aksesoris') ?>">Aksesoris</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="<?= base_url('img/icon/search.png') ?>" alt=""></a>
                    <a href="#"><img src="<?= base_url('img/icon/heart.png') ?>" alt=""></a>
                    <a class="cart-switch"><img src="<?= base_url('img/icon/cart.png') ?>" alt="">
                        <span>
                            <?php if (session()->has('cart')) : ?>
                            <?= array_sum(array_column($_SESSION['cart'], 'qty')) ?>
                            <?php else : ?>
                            0
                            <?php endif; ?>
                        </span></a>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>