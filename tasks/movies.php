<?php

include 'files.php';
include 'movie.php';
include 'form.php';

$formInputs = [
    [
        'name' => 'movieType',
        'placeholder' => 'Ar tai filmas kine ar videonuomoje?',
        'type' => 'select'
    ],
    [
        'name' => 'title',
        'placeholder' => 'Movie title',
        'type' => 'text'
    ],
    [
        'name' => 'synopsis',
        'placeholder' => 'Movie synopsis',
        'type' => 'text'
    ],
    [
        'name' => 'year',
        'placeholder' => 'Year released',
        'type' => 'number'
    ],
    [
        'name' => 'date',
        'placeholder' => 'Rental duration/Cinema premiere',
        'type' => 'text'
    ],
    [
        'name' => 'price',
        'placeholder' => 'Rental price/Cinema ticket price',
        'type' => 'text'
    ],
];

$form = new MovieForm($formInputs);

$form->processFormRequest($_POST);

$fileManager = new FileManager('data/filmai.json');

$filmJson = $fileManager->readJsonToArray();
?>

<div class="row">
    <div class="col">
        <?php
        $form->generateFormHtml();
        ?>
    </div>
</div>

<hr />

<?php

$movieList = new MovieList();

?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
            Filmai kine <span class="badge bg-primary"><?= count($movieList->cinemaMovies); ?></span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
            Filmai nuomoje <span class="badge bg-primary"><?= count($movieList->rentalMovies); ?></span>
        </button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <?php
            foreach ($movieList->cinemaMovies as $movie) {
                echo $movie->generateOutput();
            }
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
            <?php

            foreach ($movieList->rentalMovies as $movie) {
                echo $movie->generateOutput();
            }
            ?>
        </div>
    </div>
</div>