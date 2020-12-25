<!DOCTYPE html>
<html lang="zxx">

<?= $this->include('layoutfontend/head') ?>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>

    <?= $this->include('layoutfontend/haedermini') ?>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?= $this->include('layoutfontend/header') ?>
    <!-- Header Section End -->


    <!-- render section -->
    <?= $this->renderSection('content') ?>




    <!-- Footer Section Begin -->
    <?= $this->include('layoutfontend/footer') ?>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- keranjang belanja Begin -->
    <div class="backdrop"></div>
    <div class="cart-model">
        <div class="cart-model-wrapper">
            <div class="header">
                <i class="fa fa-close close-switch"></i>
                KERANJANG BELANJA
            </div>
            <div class="cart-wrapper">
                <?php if (session()->has('cart')) : $items = $_SESSION['cart']; ?>
                <?php foreach ($items as $item) : ?>
                <div class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img src="<?= base_url('images/products/' . $item['image']); ?>" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <a href="">
                            <h6 class="name"><?= $item['nama'] ?></h6>
                        </a>
                        <h5 class="harga"><?= $item['hrgjual'] ?></h5>
                        <p>Jumlah : <?= $item['qty'] ?> / Ukuran : L
                        </p>
                    </div>
                    <div class="product__cart__item__del">
                        <a href="<?= base_url('remove/' . $item['id']); ?>"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
                <!-- <div class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img src="img/shopping-cart/cart-1.jpg" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <a href="">
                            <h6 class="name">T-shirt Contrast Pocket</h6>
                        </a>
                        <h5 class="harga">Rp. 127.000</h5>
                        <p>Jumlah : 1 / Ukuran : L
                        </p>
                    </div>
                    <div class="product__cart__item__del">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img src="img/shopping-cart/cart-1.jpg" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <a href="">
                            <h6 class="name">T-shirt Contrast Pocket</h6>
                        </a>
                        <h5 class="harga">Rp. 127.000</h5>
                        <p>Jumlah : 1 / Ukuran : L / Warna : <span style="background-color: #b74d24;"></span></p>
                    </div>
                    <div class="product__cart__item__del">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <div class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img src="img/shopping-cart/cart-1.jpg" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <a href="">
                            <h6 class="name">T-shirt Contrast Pocket</h6>
                        </a>
                        <h5 class="harga">Rp. 127.000</h5>
                        <p>Jumlah : 1 / Ukuran : L / Warna : <span style="background-color: #b74d24;"></span></p>
                    </div>
                    <div class="product__cart__item__del">
                        <i class="fa fa-trash"></i>
                    </div>
                </div> -->
            </div>
            <div class="cart-footer">
                <div class="footer-total">
                    <span class="sum">Total</span>
                    <span class="sum_total">
                        <?php if (session()->has('cart')) : $total =  $_SESSION['cart'];
                            $s = 0 ?>
                        <?php foreach ($total as $tot) :  $s += $item['qty'] * $item['hrgjual']; ?>
                        <?= rupiah($s); ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        0
                        <?php endif; ?>
                    </span>
                </div>
                <a href="#" class="primary-btn">Checkout </a>
            </div>
        </div>
    </div>
    <!-- keranjan belanja End -->

    <!-- Js Plugins -->
    <?= $this->include('layoutfontend/js') ?>
</body>

</html>