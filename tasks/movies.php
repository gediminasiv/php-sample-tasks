<?php

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
    ]
];

$form = new MovieForm($formInputs);

$form->processFormRequest($_POST);

$filmJson = json_decode(file_get_contents('data/filmai.json'), true);
?>

<div class="row">
    <div class="col">
        <?php
        $form->generateFormHtml();
        ?>
    </div>
</div>

<div class="row">
    <?php
    foreach ($filmJson as $movie) {
        if ($movie['movieType'] === 'cinema') {
            $movieObject = new CinemaMovie;
            $movieObject->setMovieInformation($movie['title'], $movie['synopsis'], $movie['year'], $movie['imageUrl']);
            $movieObject->generateOutput();

            continue;
        }

        $movieObject = new RentalMovie;
        $movieObject->setMovieInformation($movie['title'], $movie['synopsis'], $movie['year'], $movie['imageUrl']);
        $movieObject->generateOutput();
    }
    ?>
</div>