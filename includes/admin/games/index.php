<?php


$queryPublishers = "select id, name from publishers";
$publishers = $connection->query($queryPublishers)->fetchAll();
$queryGenres = "select * from genres";
$genres = $connection->query($queryGenres)->fetchAll();
$gamesQuery  = "select g.*, p.name as platformName from games g join platforms p on g.publisher_id = p.id";
$games = $connection->query($gamesQuery)->fetchAll();


?>
<main class="container">
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="table-responsive-sm table-responsive-md">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Platform name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="games">
                        <?php
                        $index = 1;
                        foreach ($games as $game) :
                        ?>
                            <tr id='game_<?= $index ?>'>
                                <th scope="row"><?= $index ?></th>
                                <td><?= $game->name ?></td>
                                <td><?= $game->platformName ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($game->created_at)); ?></td>
                                <td><?= $game->updated_at != null ? date('d/m/Y H:i:s', strtotime($game->updated_at)) : "-" ?></td>
                                <td><a class="btn btn-primary btn-sm" href='admin.php?page=show&id=<?= $game->id ?>'>Editions</a></td>
                                <td><button type="button" class="btn btn-sm btn-success btn-edit-game" data-id='<?= $game->id ?>' data-index='<?= $index ?>'>Edit</button></td>
                                <td><button type="button" class="btn btn-sm btn-danger btn-delete-game" data-id='<?= $game->id ?>' data-index='<?= $index ?>' data-status='<?= $game->is_deleted ?>'>
                                        <?= $game->is_deleted == 0 ? "Delete" : "Activate" ?>
                                    </button></td>
                            </tr>
                        <?php $index++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 mt-2 mt-lg-0 my-2">
            <form action="#">
                <input type="hidden" name="game_id" id="game_id">
                <input type="hidden" name="game_index" id="game_index">
                <div class="mb-3">
                    <label for="name" class="mb-1">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span id="name_error" class="d-inline-block mt-1"></span>
                </div>
                <div class="mb-3">
                    <label for="description" class="mb-1">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                    <span id="description_error" class="d-inline-block mt-1"></span>
                </div>
                <div class="mb-3">
                    <label for="publishers" class="mb-1">Publishers</label>
                    <select name="publishers" id="publishers" class="form-select mb-1">
                        <option value="0">Choose</option>
                        <?php
                        foreach ($publishers as $publisher) :
                        ?>
                            <option value="<?= $publisher->id ?>"><?= $publisher->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="publisher_error" class="d-inline-block mt-1"></span>
                </div>
                <div class="mb-3">
                    <label for="genres" class="mt-1">Genres</label>
                    <div class="row">
                        <?php foreach ($genres as $genre) : ?>
                            <div class="col-6 text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?= $genre->id ?>" id="genre_<?= $genre->id ?>" name='genres'>
                                    <label class="form-check-label" for="genre_<?= $genre->id ?>">
                                        <?= $genre->name ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <span id="genres_error" class="d-inline-block mt-1"></span>
                </div>
                <div class="d-grid"><button class="btn btn-primary" id="btnSaveGame">Save</button></div>
            </form>
        </div>
    </div>
</main>