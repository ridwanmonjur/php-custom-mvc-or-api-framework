<?php $title = "Product List" ?>
<?php require_once(dirname(__FILE__) . "/../layouts/header.php"); ?>
<script src="assets/js/deleteForm.js"> </script>

<body>
    <nav>
        <div class="nav-wrapper mx-5">
            <a href="#!" class="brand-logo">
                Product List
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><button onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>addProduct'"
                        type="button" class="red lighten-1 waves-effect waves-light btn-large">ADD</button></li>
                <li>
                    <button type="submit" id="delete-product-btn" type="submit" form="delete_form"
                        class=" red lighten-1 waves-effect waves-light btn-large">MASS DELETE</button>
                </li>
            </ul>
            <ul class="sidenav" id="mobile-demo">
                <li><a onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>addProduct'"
                        class="red lighten-1 waves-effect waves-light btn-large" type="button">ADD</a></li>
            </ul>
        </div>
    </nav>
    <main id="body">
        <div class="container">
            <form id="delete_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST"
                onsubmit="deleteForm(event);">
                <div class="row min-h-full my-5 py-5">
                    <?php foreach ($data as $product): ?>
                        <div class="col s4">
                            <div class="card-panel px-5 py-5">
                                <label>
                                    <input type="checkbox" name="sku[]" value="<?= $product->getSku() ?>"
                                        class="delete-checkbox">
                                    <span> </span>
                                </label>
                                <div class="center-align">
                                    <p class="">
                                        <?= $product->getSku() ?>
                                    </p>
                                    <p class="">
                                        <?= $product->getName() ?>
                                    </p>
                                    <p class="">
                                        <?= $product->getPrice() ?> $
                                    </p>
                                    <p class="">
                                        <?= $product->getAttribute() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" id="delete-product-btn" type="submit" form="delete_form"
                    class="hide-on-large-only red lighten-1 waves-effect waves-light btn-large">MASS DELETE</button>
            </form>
        </div>
    </main>

    <?php require_once(dirname(__FILE__) . "/../layouts/footer.php"); ?>