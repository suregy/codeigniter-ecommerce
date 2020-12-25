<?= $this->extend('layoutfontend/template') ?>

<?= $this->section('content') ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="<?= base_url() ?>">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">

                                                <?php foreach ($c2 as $indx => $c2) :   ?>
                                                    <li><a class="category" data-type="<?= $c2['c2'] ?>" value=" <?= $c2['c2'] ?>"><?= $c2['namacategory']; ?>
                                                            (<?= $c2['count'] > '0' ? $c2['count'] : '0'  ?>)</a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <?php foreach ($brands as $br) : ?>
                                                <ul>
                                                    <li><a class="brands" value="<?= $br['id']; ?>" data-type="<?= $br['id']; ?>"><?= $br['namabrands']; ?></a>
                                                    </li>
                                                </ul>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Urutkan:</p>
                                <select id="sort">
                                    <option data-type="1">Termurah</option>
                                    <option data-type="2">Termahal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($produk as $pr) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?= base_url('images/products/' . $pr['image']); ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?= base_url('img/icon/heart.png') ?>" alt=""></a></li>
                                        </li>
                                        <li><a href="<?= base_url('produk/' . $pr['slug']); ?>"><img src="<?= base_url('img/icon/search.png') ?>" alt=""><span>Details</span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $pr['nama']; ?></h6>

                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5><?= rupiah($pr['hrgjual']); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $pager->links('products', 'page_produk'); ?>
                        <div class="product__pagination">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
<script type="text/javascript" src="<?= base_url('customjs/frondend.js') ?>"></script>

<?= $this->endSection(); ?>