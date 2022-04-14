<?php

include 'database.php';
include 'movie.php';
include 'form.php';

$formInputs = [
    [
        'name' => 'fileToUpload',
        'placeholder' => 'Filmo plakatas',
        'type' => 'file'
    ],
    [
        'name' => 'type',
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
        'name' => 'rentalDuration',
        'placeholder' => 'Rental duration',
        'type' => 'text',
        'class' => 'rental'
    ],
    [
        'name' => 'rentalPrice',
        'placeholder' => 'Rental price',
        'type' => 'number',
        'class' => 'rental'
    ],
    [
        'name' => 'premiereDate',
        'placeholder' => 'Cinema premiere date',
        'type' => 'text',
        'class' => 'cinema',
    ],
    [
        'name' => 'ticketPrice',
        'placeholder' => 'Cinema ticket price',
        'type' => 'number',
        'class' => 'cinema',
    ],
];

$form = new MovieForm($formInputs);

$form->processFormRequest($_POST);
?>

<div class="row">
    <div class="card col-3">
        <?php if (isset($_SESSION['userId'])) { ?>

            <div class="card-body">
                <h5 class="card-title">Pridėti filmą</h5>
                <?php
                $form->generateFormHtml();
                ?>
            </div>

        <?php } else { ?>

            <div class="card-body">
                <p>Filma i sarasa galima prideti tik prisijungus</p>
                <a class="btn btn-primary" href="?page=login">Prisijungimas</a>
            </div>

        <?php } ?>
    </div>

    <div class="col-8 offset-1">
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
    </div>
</div>