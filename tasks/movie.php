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

    function generateOutput()
    {
        echo '<div class="card col-4">';
        echo '<img class="card-img-top" src="' . $this->imageUrl . '" alt="' . $this->title . '"/>';
        echo '<div class="card-body">';
        echo '<h3>' . $this->generateMovieCardTitle() . '</h3>';
        echo '<p class="card-text">' . $this->synopsis . '</p>';
        echo '</div></div>';
    }
}
