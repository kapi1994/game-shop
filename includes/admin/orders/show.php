<?php
$order_id = '';
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
}
$orderItems = orderItems($order_id);
$orderTotal = orderTotal($order_id);
?>
<main class="container">
    <div class="row mt-5 mb-2">
        <?php
        foreach ($orderItems as $orderItem) :
        ?>
            <div class="col-lg-2 mb-2 mb-lg-0">
                <div class="card h-100">
                    <img src="assets/img/<?= $orderItem->image_path ?>" class="img-card" alt="...">
                    <div class="card-body">
                        <h5 class="text-center"><?= $orderItem->platformName . ' ' . $orderItem->name ?></h5>
                        <h6 class="card-subtitle fw-bold text-end mt-3"><?= $orderItem->quantity . 'x' . $orderItem->price ?>.00</h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <hr>
    <h6 class="text-end">
        Total:
        <span class="mx-2 fw-bold"><?= $orderTotal->total ?></span>
    </h6>
</main>