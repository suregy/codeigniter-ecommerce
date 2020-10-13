<!DOCTYPE html>
<html lang="zxx">

<?= $this->include('layoutfontend/head') ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

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

    <!-- Js Plugins -->
    <?= $this->include('layoutfontend/js') ?>
</body>

</html>