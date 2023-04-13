<?php
$user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : "";
$wishlistItems = wishlistItems($user_id);

?>
<main class="container">
    <div class="row mt-5">
        <div id="wishlist_response_messages"></div>
        <div class="row mx-auto" id="items">
            <?php
            if (count($wishlistItems) == 0) :
            ?>
                <h1 class="text-center mt-5">Your wishlist is empty!</h1>
                <div class="col-lg-2 mt-2 mx-auto">
                    <div class="d-grid">
                        <a href="index.php?page=games" class="btn btn-primary">Back to games</a>
                    </div>
                </div>

                <?php else :
                foreach ($wishlistItems as $wishlistItem) : ?>
                    <div class="col-lg-3 col-6 mb-2">
                        <div class="card h-100">
                            <img src="assets/img/<?= $wishlistItem->image_path ?>" class="img-fluid" alt="...">
                            <div class="card-body text-center">
                                <h3 class="card-title"><?= $wishlistItem->platformName . ' - ' . $wishlistItem->gameName ?></h3>
                                <h5 class="fw-bold"><?= "(" . $wishlistItem->editionName . ' ' . " Edition) " ?></h5>

                                <div class="d-block text-lg-end text-uppercase fw-bold"><?= $wishlistItem->price . '.00 RSD' ?></div>
                            </div>
                            <div class="card-footer">
                                <div class="d-grid gap-1">
                                    <button type="button" class="btn btn-primary btn-add-to-cart" data-id='<?= $wishlistItem->gameEditionId ?>'>Add to cart</button>
                                    <button type="button" class="btn btn-danger btn-remove-from-wishlist" data-id='<?= $wishlistItem->wishlistItemId ?>'>Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</main>