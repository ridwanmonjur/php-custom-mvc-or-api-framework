<?php
// session_start();
$baseUrl = getBaseUrl();
$count = 0;
$errors = [];
$baseUrl = getBaseUrl();
// if (isset($_SESSION["formErrors"])) {
//     $errors = $_SESSION["formErrors"];
//     $count = count($errors);
// }
?>
<?php $title = "Error Page" ?>
<?php require_once(dirname(__FILE__) . "/layouts/header.php"); ?>

<body>

    <nav class="navbar is-warning py-5">
        <div class="navbar-brand px-5 mx-5">
            <a class="navbar-item" href="<?= $baseUrl ?>/addProduct">
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
                <!-- <button type="submit" form="product_form" name="submit"
                    class="button are-large is-info mx-5 is-hidden-touch">Save
                </button> -->
                <button onclick="window.location.href='<?= $baseUrl ?>'" class="button are-large is-info ">Cancel
                </button>
            </div>
        </div>
    </nav>
    <main id="body">
        <form id="product_form" action="<?php echo $baseUrl . "/"; ?>" method="POST" class="mx-5 px-5 py-5 my-5"
            novalidate>
            <div class="row">
                <article class="message is-danger is-light col-12-sm col-7">
                    <div class="message-header">
                        <p>Error</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        You entered wrong data into the form. Please submit all required data in correct format
                    </div>
                </article>

            </div>

        </form>
    </main>

    <?php require_once(dirname(__FILE__) . "/layouts/footer.php"); ?>
    <!-- <?php require_once(dirname(__FILE__) . "/layouts/session.php"); ?> -->