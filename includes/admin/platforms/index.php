<?php
$platforms = getAllPlatforms();
$pagintion = pagination('platforms');

?>
<main class="container">
    <div class="row mt-5">
        <div id="platforms_response_messages"></div>
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
                    <tbody id="platforms">
                        <?php
                        $index = 1;
                        foreach ($platforms as $platform) :
                        ?>
                            <tr id="platform_<?= $index ?>">
                                <th scope="row"><?= $index ?></th>
                                <td><?= $platform->name ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($platform->created_at)) ?></td>
                                <td><?= $platform->updated_at != null ? date('d/m/Y H:i:s', strtotime($platform->updated_at)) : '-' ?></td>
                                <td><button type="button" class="btn btn-sm btn-success btn-edit-platform" data-id='<?= $platform->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button type="button" class="btn btn-sm btn-danger btn-delete-platform" data-id='<?= $platform->id ?>' data-index='<?= $index ?>' data-status='<?= $platform->is_deleted ?>'>
                                        <?= $platform->is_deleted == 0 ? "Delete" : "Activate" ?>
                                    </button></td>
                            </tr>
                        <?php
                            $index++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="platform_pagination_links">
                        <?php
                        for ($i = 0; $i < $pagintion; $i++) :
                        ?>
                            <li class="page-item platform_pagination_link" data-limit='<?= $i ?>'><a class="page-link <?php if ($i == 0) : ?> active <?php endif; ?>" href="#"><?= $i + 1 ?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-4 py-2 mt-2 mt-lg-0">
            <form action="#">
                <input type="hidden" name="platform_id" id="platform_id">
                <input type="hidden" name="platform_index" id="platform_index">
                <div class="mb-3">
                    <label for="name" class="mb-1">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span id="name_error" class="d-inline-block mt-1"></span>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="button" id="btnSavePlatform">Save</button>
                </div>
            </form>
        </div>
    </div>
</main>