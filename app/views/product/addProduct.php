<?php $title = "Add Product" ?>
<?php require_once(dirname(__FILE__) . "/../layouts/header.php"); ?>

<body>
    <?php echo getRootFolderName(); ?>
    <?php echo getBaseUrl(); ?>
    <?php echo $_SERVER["REQUEST_URI"]; ?>


    <nav>
        <div class="nav-wrapper mx-5">
            <a href="#!" class="brand-logo">
                Add Product
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li>
                    <button type="submit" form="product_form" name="submit"
                        class="red lighten-1 waves-effect waves-light btn-large">Save
                    </button>
                </li>
                <li>
                    <button onclick="window.location.href='<?php echo getBaseUrl(); ?>'" id="delete-product-btn"
                        class=" red lighten-1 waves-effect waves-light btn-large">
                        Cancel
                    </button>
                </li>
            </ul>
            <ul class="sidenav" id="mobile-demo">
                <li>
                    <a onclick="window.location.href='<?php echo getBaseUrl(); ?>'" id="delete-product-btn"
                        class="red lighten-1 waves-effect waves-light btn-large">
                        Cancel
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="body">
        <div class="container my-5 py-5">
            <form id="product_form" action="<?php echo getRootFolderName() . "/"; ?>" method="POST">
                <div class="row">
                    <label class="col s10 l2 label-fix" for="sku">SKU</label>
                    <div class="col s10 l6">
                        <input type="text" name="sku" id="sku"
                            placeholder="Strictly alphanumeric and dashes (8-10 digits)" minlength="8" maxlength="10"
                            required>
                    </div>
                </div>

                <div class="row">
                    <label class="col s10 l2 label-fix" for="name">Name</label>
                    <div class="col s10 l6">
                        <input type="text" name="name" id="name" placeholder="Insert any alphanumeric characters"
                            required>
                    </div>
                </div>

                <div class="row">
                    <label class="col s10 l2 label-fix" for="price">Price ($)</label>
                    <div class="col s10 l6">
                        <input type="number" step="0.1" name="price" id="price"
                            placeholder="Insert any non-negative number" required>
                    </div>

                </div>

                <div class="row">
                    <label class="col s10 l2 label-fix" for="switcher">Type Switcher</label>
                    <div class="col s10 l6 input-field">
                        <select class="browser-default" name="switcher" id="productType" required>
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
                    class="red hide-on-large-only lighten-1 waves-effect waves-light btn-large">Save
                </button>
            </form>
        </div>
    </main>
    <script src="assets/js/switchForm.js"> </script>
    <?php require_once(dirname(__FILE__) . "/../layouts/footer.php"); ?>