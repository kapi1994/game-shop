<?php
$game_id = '';
if ($_GET['id']) {
    $game_id = $_GET['id'];
}
$editionType = editionType();
$platforms = availablePlatforms();
$editions = editions($game_id);

?>
<main class="container">
    <div class="row mt-5">
        <div id="editions_response_message"></div>
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Platform name</th>
                            <th scope="col">Edition name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="editions">
                        <?php
                        $index = 1;
                        foreach ($editions as $edition) :
                        ?>
                            <tr id="edition_<?= $index ?>">
                                <th scope="row"><?= $index ?></th>
                                <td><?= $edition->platformName ?></td>
                                <td><?= $edition->editionName ?></td>
                                <td><?= $edition->price ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($edition->created_at)); ?></td>
                                <td><?= $edition->updated_at != null ? date('d/m/Y H:i:s', strtotime($edition->updated_at)) : '-' ?></td>
                                <td><button class="btn btn-sm btn-success btn-edit-edition" data-id='<?= $edition->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button class="btn btn-sm btn-danger btn-delete-edition" data-id='<?= $edition->id ?>' data-status='<?= $edition->is_deleted ?>' data-index='<?= $index ?>'>
                                        <?= $edition->is_deleted == 0 ? "Delete" : "Activate" ?>
                                    </button></td>
                            </tr>
                        <?php $index++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0 py-2">
            <form action="#" id="edition_form">
                <input type="hidden" name="game_edition_index" id="game_edition_index">
                <input type="hidden" name="game_edition_id" id="game_edition_id">
                <input type="hidden" name="game_id" id="game_id" value="<?= $game_id ?>">
                <div class="mb-3">
                    <label for="edition" class="mb-1">Editions</label>
                    <select name="edition" id="edition" class="form-select">
                        <option value="0">Default</option>
                        <?php
                        foreach ($editionType as $edType) :
                        ?>
                            <option value="<?= $edType->id ?>"><?= $edType->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="edition_error" class="mt-1"></span>
                </div>
                <div class="mb-3">
                    <label for="price" class="mt-1">Price</label>
                    <input type="number" name="price" id="price" min='100' step='100' class="form-control">
                    <span id="price_error" class="mt-1"></span>
                </div>
                <div class="mb-3">
                    <label for="platform">Platform</label>
                    <select name="platform" id="platform" class="form-control">
                        <option value="0">Choose</option>
                        <?php foreach ($platforms as $platform) : ?>
                            <option value="<?= $platform->id ?>"> <?= $platform->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div id="platform_error" class="mt-1"></div>
                </div>
                <div class="mb-3">
                    <label for="image" class="mt-1">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <div class="mt-1" id="image_error"></div>
                </div>
                <div class="d-grid"><button class="btn btn-primary" id="btnSaveEdition" type="button">Save</button></div>
                <img src="#" alt="" id="img-cover" class=" mt-2 img-fluid">
            </form>

        </div>
    </div>
</main>