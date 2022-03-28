<?php

class Movie
{
    public $title;
    public $synopsis;
    public $releaseYear;
    public $imageUrl;

    function setMovieInformation($pavadinimas, $sinopsis, $metai, $imageUrl)
    {
        $this->title = $pavadinimas;
        $this->synopsis = $sinopsis;
        $this->releaseYear = $metai;
        $this->imageUrl = $imageUrl;
    }

    function generateMovieCardTitle()
    {
        return $this->title . ' (' . $this->releaseYear . ')';
    }
}

class CinemaMovie extends Movie
{
    public $ticketPrice; // kiek kainuos bilietas i kina
    public $premiereDate; // kada vyks premjera

    function generateOutput()
    {
        echo '<div class="card col-4">';
        echo '<img class="card-img-top" src="' . $this->imageUrl . '" alt="' . $this->title . '"/>';
        echo '<div class="card-body">';
        echo '<h3>' . $this->generateMovieCardTitle() . '</h3>';
        echo '<p class="card-text">' . $this->synopsis . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<p>Premjeros data: ' . $this->premiereDate . '</p>';
        echo '<p>Bilieto kaina: ' . $this->ticketPrice . '$</p>';
        echo '</div></div>';
    }
}

class RentalMovie extends Movie
{
    public $rentalPrice; // kiek kainuoja issinuomoti filma
    public $rentalDuration; // kuriam laikui galima issinuomoti filma

    function generateOutput()
    {
        echo '<div class="card col-4">';
        echo '<img class="card-img-top" src="' . $this->imageUrl . '" alt="' . $this->title . '"/>';
        echo '<div class="card-body">';
        echo '<h3>' . $this->generateMovieCardTitle() . '</h3>';
        echo '<p class="card-text">' . $this->synopsis . '</p>';
        echo '</div>';
        echo '<div class="card-footer">';
        echo '<p>Nuomos kaina: ' . $this->rentalPrice . '$</p>';
        echo '<p>Nuomos trukme: ' . $this->rentalDuration . ' d.</p>';
        echo '</div></div>';
    }
}

class MovieList extends FileManager
{
    public $cinemaMovies = [];
    public $rentalMovies = [];

    function __construct()
    {
        parent::__construct('data/filmai.json');
        $this->sortFilmsByType();
    }

    function sortFilmsByType()
    {
        $filmJson = $this->readJsonToArray();

        foreach ($filmJson as $movie) {
            $object = $movie['movieType'] === 'cinema' ? new CinemaMovie : new RentalMovie;

            $object->setMovieInformation($movie['title'], $movie['synopsis'], $movie['year'], $movie['imageUrl']);

            if ($movie['movieType'] === 'cinema') {
                $object->ticketPrice = $movie['ticketPrice'];
                $object->premiereDate = $movie['premiereDate'];

                $this->cinemaMovies[] = $object;
            } else {
                $object->rentalDuration = $movie['rentalDuration'];
                $object->rentalPrice = $movie['rentalPrice'];

                $this->rentalMovies[] = $object;
            }
        }
    }
}
