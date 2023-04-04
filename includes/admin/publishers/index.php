<?php
$publishers = getAllPublishers();
$publisherPagination = pagination('publishers');


?>
<main class="container">
    <div class="row mt-5">
        <div id="publisher_response_messages"></div>
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="publishers">
                        <?php
                        $index = 1;
                        foreach ($publishers as $publisher) : ?>
                            <tr id="publisher_<?= $index ?>">
                                <th scope="row"><?= $index ?></th>
                                <td><?= $publisher->name ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($publisher->created_at)); ?></td>
                                <td><?= $publisher->updated_at != null ? date('d/m/Y H:i:s', strtotime($publisher->updated_at)) : '-' ?></td>
                                <td><button type="button" class="btn btn-sm btn-success btn-edit-publisher" data-id='<?= $publisher->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button type="button" class="btn btn-sm btn-danger btn-delete-publisher" data-id='<?= $publisher->id ?>' data-index='<?= $index ?>' data-status='<?= $publisher->is_deleted ?>'>
                                        <?= $publisher->is_deleted == 0 ? "Delete" : "Activate" ?></button></td>
                            </tr>
                        <?php
                            $index++;
                        endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="publisher_pagination_links">
                        <?php for ($i = 0; $i < $publisherPagination; $i++) : ?>
                            <li data-limit='<?= $i ?>' class="page-item publisher_pagination_link <?php if ($i == 0) : ?> active <?php endif; ?>"><a class="page-link" href="#"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 py-2 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="publisher_id" id="publisher_id">
                <input type="hidden" name="publisher_index" id="publisher_index">
                <div class="mb-3">
                    <label for="name" class="mb-1">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span id="name_error" class="d-inline-block mt-1"></span>
                </div>
                <div class="d-grid"><button class="btn btn-primary" id="btnSavePublisher">Save</button></div>
            </form>
        </div>
    </div>
</main>