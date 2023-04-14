<?php
$user_id = $_SESSION['user']->id;
$cartItems = cartItems($user_id);

?>
<div class="container">
    <div class="row mt-5">
        <div id="cart_response_messages"></div>
        <div class="row mx-auto" id="items">
            <?php
            if (count($cartItems) == 0) :
            ?>
                <h1 class="text-center mt-5">Your cart is empty!</h1>
                <div class="col-lg-2 mt-2 mx-auto">
                    <div class="d-grid">
                        <a href="index.php?page=games" class="btn btn-primary">Back to games</a>
                    </div>
                </div>
                <?php else :
                foreach ($cartItems as $cartItem) : ?>
                    <div class="col-lg-3 col-6 mb-2">
                        <div class="card">
                            <img src="assets/img/<?= $cartItem->image_path ?>" class="img-card" alt="...">
                            <div class="card-body text-center h-100">
                                <h3 class="card-title"><?= $cartItem->platformName . ' - ' . $cartItem->gameName ?></h3>
                                <h5 class="fw-bold"><?= "(" . $cartItem->editionName . ' ' . " Edition) " ?></h5>
                                <div class="d-block text-lg-end text-uppercase fw-bold">
                                    <span id='game_quantity_<?= $cartItem->quantity ?>'><?= $cartItem->quantity ?></span>
                                    <span class="mt-2">x</span>
                                    <span><?= $cartItem->price . ".00 RSD" ?></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="my-2 d-none" id='game_update_<?= $cartItem->gameEditionId ?>'>
                                    <form action="#">
                                        <input type="hidden" name="game_edition_id" id="game_edition_id" value="<?= $cartItem->gameEditionId ?>">
                                        <input type="hidden" name="cart_id_udpate" id="cart_id_udpate" value="<?= $cartItem->cartItemId ?>">
                                        <div class="mb-3">
                                            <label for="quantity" class="mb-1">New quantity</label>
                                            <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $cartItem->quantity ?>" step="1" min="1">
                                            <div id="quantity_error" class="mt-1"></div>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary btn-edit-quantity" type="button">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-grid gap-1">
                                    <button type="button" class="btn btn-primary btn-change-quantity" data-id='<?= $cartItem->gameEditionId ?>'>Edit</button>
                                    <button type="button" class="btn btn-danger btn-remove-from-cart" data-id='<?= $cartItem->cartItemId ?>'>Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>