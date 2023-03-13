<?php $title = "Product List" ?>
<?php require_once(dirname(__FILE__) . "/../layouts/header.php"); ?>

<body>
    <nav class="navbar is-warning py-5">
        <div class="navbar-brand px-5 mx-5">
            <a class="navbar-item" href="<?= getBaseUrl() ?>">
                Product List
            </a>
            <div class="navbar-burger burger" data-target="navMenubd-example">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navMenubd-example" class="navbar-menu mx-5 mt-2 px-5 has-background-warning is-shadowless">
            <div class="navbar-end">
                <button onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>addProduct'" type="button"
                    class="button are-large is-info mx-5">ADD
                </button>
                <button type="submit" id="delete-product-btn" type="submit" form="delete_form"
                    class="button are-large is-info is-hidden-touch">MASS DELETE
                </button>
            </div>
        </div>
    </nav>
    <main id="body">
        <div>
            <form id="delete_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="py-5 mx-5"
                onsubmit="deleteForm(event);">
                <div class="row py-5 px-5">
                    <?php foreach ($data as $index => $product): ?>

                        <div class="col-12-sm col-4 is-one-quarter-widescreen">
                            <div class="card px-5 mb-5">
                                <div class="card-content">
                                    <label class="checkbox">
                                        <input type="checkbox" name="sku[]" value="<?= $product->getSku() ?>"
                                            class="delete-checkbox">
                                        <span>
                                            <?= $product->getSku() ?>
                                        </span>
                                    </label>
                                    <div class="">
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
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" id="delete-product-btn-2" type="submit"
                    class="button are-large is-info is-hidden-desktop is-block-touch my-5 mx-5 has-text-centered">MASS
                    DELETE
                </button>
            </form>
        </div>
    </main>

    <?php require_once(dirname(__FILE__) . "/../layouts/footer.php"); ?>