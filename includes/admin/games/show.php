<?php
$game_id = '';
$editionsQuery = "select * from editions";
$editions = $connection->query($editionsQuery)->fetchAll();
if ($_GET['id']) {
    $game_id = $_GET['id'];
}
?>
<main class="container">
    <div class="row mt-5">
        <div class="col-lg-8"></div>
        <div class="col-lg-4 mt-2 mt-lg-0 py-2">
            <input type="hidden" name="game_edition_index" id="game_edition_index">
            <input type="hidden" name="game_edition_id" id="game_edition_id">
            <input type="hidden" name="game_id" id="game_id" id="<?= $game_id ?>">
            <div class="mb-3">
                <label for="editions" class="mb-1">Editions</label>
                <select name="editions" id="editions" class="form-select">
                    <option value="0">Default</option>
                    <?php
                    foreach ($editions as $edition) :
                    ?>
                        <option value="<?= $edition->id ?>"><?= $edition->name ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="editions" class="mt-1"></span>
            </div>
            <div class="mb-3">
                <label for="price" class="mt-1">Price</label>
                <input type="number" name="price" id="price" min='100' step='100'>
                <span id="price_error" class="mt-1"></span>
            </div>
        </div>
    </div>
</main>