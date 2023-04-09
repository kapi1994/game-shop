<?php

$publisher = getPublisherForGames();
$genres = getAllGenres();



?>
<main class="container">
    <div class="row mt-5">
        <div id="games_response_messages"></div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-4"><input type="text" name="search-game" id="search-game" class="form-control" placeholder="Search..."></div>
            </div>
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

                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination" id="game-pagiation-links">

                    </ul>
                </nav>
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