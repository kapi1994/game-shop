<?php
// $orders = getAllOrders();
$pagintion = pagination('orders');
?>
<main class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="row my-2">
                <div class="col-lg-3">
                    <input type="text" name="search-order" id="search-order" class="form-control" placeholder="Search orders....">
                </div>
            </div>
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="row">#</th>
                            <th scope="row">Full name</th>
                            <th scope="row">Created at</th>
                            <th scope="row">Details</th>
                        </tr>
                    </thead>
                    <tbody id="orders">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <nav aria-label="Page navigation example">
                <ul class="pagination" id="order_pagination_links">
                    <?php for ($i = 0; $i < $pagintion; $i++) : ?>
                        <li class="page-item"><a class="page-link <?php if ($i == 0) : ?> active <?php endif; ?>" href="admin.php?page=orders&limit=<?= $i  ?>"><?= $i + 1 ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</main>