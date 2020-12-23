<?= $this->extend('layoutfontend/template') ?>

<?= $this->section('content') ?>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <?php foreach ($details as $detail) : ?>
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php $i = 1; ?>
                            <?php foreach ($detail['images'] as  $key => $img) : ?>

                                <li class="nav-item">
                                    <a class="nav-link <?= $i === 1 ? 'active' : '' ?>" data-toggle="tab" href="#tabs-<?= $i++ ?>" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="<?= base_url('images/products/' . $img['file']);  ?>">
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <?php $j = 1; ?>
                            <?php foreach ($detail['images'] as $img) : ?>
                                <div class="tab-pane <?= $j === 1 ? 'active' : '' ?>" id="tabs-<?= $j++ ?>" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="<?= base_url('images/products/' . $img['file']);  ?>" alt="">
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4><?= $detail['nama'] ?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3><?= rupiah($detail['hrgjual']); ?></h3>

                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <?php $s = 1; ?>
                                    <?php foreach ($detail['detail'] as $dt) : ?>
                                        <label class="<?= $s === 1 ? 'active' : '';
                                                        $s++ ?>" for="<?= $dt['size'] ?>"><?= $dt['size'] ?>
                                            <input type="radio" name="size" id="<?= $dt['size'] ?>">
                                        </label>
                                    <?php endforeach; ?>
                                </div>

                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    <?php $c = 1; ?>
                                    <?php foreach ($detail['detail'] as $dt) : ?>
                                        <label class="color <?= $c === 1 ? 'active' : '';
                                                            $c++ ?>" style="background:<?= $dt['color']; ?>" for="<?= $dt['color'] ?>">
                                            <input type="radio" name="color" id="<?= $dt['color'] ?>">
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <button class="primary-btn addCart">add to cart</button>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>

                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="img/shop-details/details-payment.png" alt="">
                                <span>Tag:</span>
                                <?php foreach ($detail['tags'] as $key => $tag) : ?>
                                    <span style="font-weight: bold;"><?= $tag['nama'] . ','; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note"> <?= $detail['deskripsi'] ?></p>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<!-- Shop Details Section End -->
<script>
    $(document).ready(function(e) {
        $('.addCart').click(function(e) {
            alert('OK');
        });
    })
</script>
<?= $this->endSection(); ?>