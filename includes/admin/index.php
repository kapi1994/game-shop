<?php
$orders = getOrderForHomePage();
?>
<main class="container">
    <div class="row mt-5">
        <div class="col-lg-9">
            <div class="row mb-2">
                <div class="col">
                    <div class="table-responsive-sm table-responsive-md">
                        <table class="table text-center align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full name</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1;
                                foreach ($orders as $order) : ?>
                                    <tr>
                                        <th><?= $index ?></th>
                                        <td><?= $order->first_name . ' ' . $order->last_name ?> </td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($order->created_at)) ?></td>
                                        <td><a href='admin.php?page=show-order&id=<?= $order->id ?>' class='btn btn-sm btn-primary'>Details</a></td>
                                    </tr>
                                <?php $index++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-2 mb-lg-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="card-title">Number of orders</h3>
                            <h4 class="card-subtitle" id="orderCount"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-2 mb-lg-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="card-title">Number of orders</h3>
                            <h4 class="card-subtitle" id="usersCount"></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="card-title">Number of products</h3>
                            <h4 class="card-subtitle" id="productsCount"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 my-2 my-lg-0">

            <canvas id="votesChart"></canvas>
            <table class="table text-center" id="voteTable">

            </table>

        </div>
    </div>
</main>