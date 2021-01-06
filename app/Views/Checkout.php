<?= $this->extend('layoutfontend/template') ?>

<?= $this->section('content') ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (session()->has('cart')) : $items = $_SESSION['cart']; ?>
                            <?php foreach ($items as $item) : ?>
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="<?= base_url('images/products/' . $item['image']); ?>" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6><?= $item['nama'] ?></h6>
                                        <h5><?= rupiah($item['hrgjual']) ?></h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <input type="text" value="<?= $item['qty'] ?>">
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price"><?= rupiah($item['hrgjual'] * $item['qty']) ?></td>
                                <td class="cart__close"><i class="fa fa-close"></i></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <tr>
                                <td colspan="3">
                                    Anda belum belanja
                                </td>

                            </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="#">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__alamat">
                    <h6>Pilih Alamat</h6>
                    <div class="form-group">
                        <select class="form-control" id="provinsi">
                            <option>Select Provinsi</option>
                            <?php foreach ($provinsi as $p) : ?>
                            <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="kab">
                            <option>Select City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="kurir">
                            <option>Select Kurier</option>
                        </select>
                    </div>
                    <strong>Estimasi : <span id="estimasi"></span></strong>
                </div>

                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$ 169.50</span></li>
                        <li>Ongkir <span id="ongkir"></span></li>
                        <li>Total <span>$ 169.50</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
<script>
$(document).ready(function(e) {
    $('#provinsi').on('change', function(e) {
        e.preventDefault();
        var idprov = $(this).val();
        $.ajax({
            url: "<?= site_url('checkout/getKota') ?>",
            type: 'GET',
            dataType: 'json',
            data: {
                idprov: idprov
            },
            success: function(response) {
                // console.log(response);
                var data = response['rajaongkir']['results'];
                var option;
                $.each(data, function(i, item) {
                    option += '<option value="' + item.city_id + '">' + item
                        .city_name + '</option>';
                });
                $('#kab').html(option);

            }
        });
    });
    $('#kab').on('change', function(e) {
        e.preventDefault();
        var idcity = $(this).val();
        $.ajax({
            url: "<?= site_url('checkout/getCost') ?>",
            type: 'GET',
            dataType: 'json',
            data: {
                "origin": 22,
                "destination": idcity,
                "weight": 1000,
                "courier": 'jne',
            },
            success: function(response) {
                console.log(response);
                var data = response['rajaongkir']['results'][0]['costs'];
                var option;
                $.each(data, function(i, item) {
                    option += '<option value="' + data[i]["cost"][0]["value"] +
                        '" etd ="' + data[i]["cost"][0]["etd"] + '">' + data[i][
                            'description'
                        ] + "(" +
                        data[i]["service"] + ")"
                    '</option>';
                });
                $('#kurir').html(option);
            }
        });
    });
    $('#kurir').on('change', function(e) {
        e.preventDefault();
        var estimasi = $('option:selected', this).attr('etd');
        $("#estimasi").html(estimasi + " Hari");
    });
});
</script>

<?= $this->endSection(); ?>