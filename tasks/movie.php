<?php

class Movie
{
    public $title;
    public $synopsis;
    public $releaseYear;
    public $imageUrl;
    public $username;

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

    function getUploadedUser()
    {
        return $this->username ? $this->username : 'Autorius nežinomas';
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
        echo '<p>Įkėlė: ' . $this->getUploadedUser() . '</p>';
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
        echo '<p>Įkėlė: ' . $this->getUploadedUser() . '</p>';
        echo '</div></div>';
    }
}

class MovieList extends Database
{
    public $userId = null;
    public $cinemaMovies = [];
    public $rentalMovies = [];

    function __construct($userId = null)
    {
        parent::__construct();

        $this->userId = $userId;

        $this->sortFilmsByType();
    }

    function sortFilmsByType()
    {
        $params = [];

        if (!$this->userId) {
            $moviesQuery = $this->pdo->prepare('SELECT * FROM movies LEFT JOIN users ON movies.user_id = users.id');
        } else {
            $moviesQuery = $this->pdo->prepare('SELECT * FROM movies
                LEFT JOIN users ON movies.user_id = users.id
                WHERE users.id = :id');
            $params['id'] = $this->userId;
        }
        $moviesQuery->execute($params);

        $movies = $moviesQuery->fetchAll();

        foreach ($movies as $movie) {
            $object = $movie['type'] === 'cinema' ? new CinemaMovie : new RentalMovie;

            $object->setMovieInformation($movie['title'], $movie['synopsis'], $movie['year'], $movie['imageUrl']);

            $object->username = $movie['username'];

            if ($movie['type'] === 'cinema') {
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
