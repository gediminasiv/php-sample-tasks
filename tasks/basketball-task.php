<?php

class Player
{
    public $name;
    public $twoPtsPercentage;
    public $threePtsPercentage;

    public $threePtsAttempts;
    public $twoPtsAttempts;

    function  __construct($name, $twoPtsPercentage, $threePtsPercentage, $threePtsAttempts, $twoPtsAttempts)
    {

        $this->name = $name;
        $this->twoPtsPercentage = $twoPtsPercentage;
        $this->threePtsPercentage = $threePtsPercentage;
        $this->twoPtsAttempts = $twoPtsAttempts;
        $this->threePtsAttempts = $threePtsAttempts;
    }

    function calculateTwoPointers()
    {
    }

    function calculateThreePointers()
    {
    }
}

class Team
{
    public $id;
    public $name;
    public $pdo;
    public $players = [];

    function __construct($id)
    {
        $this->id = $id;
        $this->pdo = new PDO('mysql:host=localhost;dbname=codeacademy;user=root;password=root');

        $this->fetchInfo();
        $this->fetchPlayers();
    }

    function fetchInfo()
    {
        $teamQuery = $this->pdo->prepare("SELECT * FROM team WHERE id=:id");

        $teamQuery->execute(['id' => $this->id]);

        $teamInfo = $teamQuery->fetch();

        $this->name = $teamInfo['name'];
    }

    function fetchPlayers()
    {
        $playersQuery = $this->pdo->prepare("SELECT * FROM basketball WHERE team_id=:id");

        $playersQuery->execute(['id' => $this->id]);

        $players = $playersQuery->fetchAll();

        foreach ($players as $player) {
            $player = new Player($player['name'], $player['2pts_percentage'], $player['3pts_percentage'], $player['2pts_attempts'], $player['3pts_attempts']);
            $this->players[] = $player;
        }
    }

    function playGame()
    {
    }
}

$team = new Team(1);

?>

<div class="row">
    <div class="col">
        <h1><?= $team->name; ?></h1>
        <ul class="list-group">
            <?php foreach ($team->players as $player) { ?>
                <li class="list-group-item">
                    <?= $player->name; ?><br />

                    <b>2pts:</b> <?= $player->twoPtsPercentage; ?>%, per rungtynes: <?= $player->twoPtsAttempts; ?><br />
                    <b>3pts:</b> <?= $player->threePtsPercentage; ?>%, per rungtynes: <?= $player->threePtsAttempts; ?>

                </li>

            <?php } ?>
        </ul>
    </div>

    <div class="col"></div>
</div>