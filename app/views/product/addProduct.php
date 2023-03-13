<?php $title = "Add Product" ?>
<?php require_once(dirname(__FILE__) . "/../layouts/header.php"); ?>

<body>
    <nav class="navbar is-warning py-5">
        <div class="navbar-brand px-5 mx-5">
            <a class="navbar-item" href="<?= getBaseUrl() ?>/addProduct">
                Add Product
            </a>
            <div class="navbar-burger burger" data-target="navMenubd-example">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navMenubd-example" class="navbar-menu mx-5 mt-2 px-5 has-background-warning is-shadowless">
            <div class="navbar-end">
                <button type="submit" form="product_form" name="submit"
                    class="button are-large is-info mx-5 is-hidden-touch">Save
                </button>
                <button onclick="window.location.href='<?php echo getBaseUrl(); ?>'"
                    class="button are-large is-info ">Cancel
                </button>
            </div>
        </div>
    </nav>
    <main id="body">
        <form id="product_form" action="<?php echo getBaseUrl() . "/"; ?>" method="POST" class="mx-5 px-5 py-5 my-5">
            <div class="row">
                <label class="col-12-sm col-3 label-fix" for="sku">SKU</label>
                <div class="col-12-sm col-4">
                    <input class="input" type="text" name="sku" id="sku" pattern="[a-zA-Z0-9\s]+"
                        placeholder="Please provide sku." 
                        required onblur="validateForms(event);">
                </div>
            </div>
            <div class="row">
                <label class="col-12-sm col-3 label-fix" for="name">Name</label>
                <div class="col-12-sm col-4">
                    <input class="input" type="text" pattern="[a-zA-Z0-9\s]+" name="name" id="name"
                        onblur="validateForms(event);" placeholder="Please provide name." required>
                </div>
            </div>
            <div class="row">
                <label class="col-12-sm col-3 label-fix" for="price">Price ($)</label>
                <div class="col-12-sm col-4">
                    <input class="input" type="number" min="0"  name="price" id="price"
                        onblur="validateForms(event);" placeholder="Insert any non-negative number for the price." required>
                </div>
            </div>
            <div class="row">
                <label class="col-12-sm col-3 label-fix" for="switcher">Type Switcher</label>
                <div class="col-12-sm col-4">
                    <select class="input" name="switcher" id="productType" required>
                        <option value="" id="none">Type Switcher</option>
                        <option value="Disc" id="Disc_form">DVD</option>
                        <option value="Furniture" id="Furniture_form">Furniture</option>
                        <option value="Book" id="Book_form">Book</option>
                    </select>
                </div>
            </div>
            <div id="switch">
            </div>
            <button type="submit" form="product_form" name="submit"
                class="button are-large is-info is-hidden-desktop is-block-touch my-5 mx-5 has-text-centered">Save
            </button>
        </form>
    </main>
    <script src="assets/js/switchForm.js"> </script>
    <script src="assets/js/validateForm.js"> </script>
    <?php require_once(dirname(__FILE__) . "/../layouts/footer.php"); ?>