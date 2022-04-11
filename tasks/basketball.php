<?php

class Database
{
    public $pdo;
    function __construct()
    {
        $this->pdo = new Pdo('mysql:host=localhost;dbname=codeacademy;user=root;password=root');
    }
}

class Player
{
    public $name;

    public $twoPtsPercentage;
    public $twoPtsAttempts; // naujai prideti kintamieji

    public $threePtsPercentage;
    public $threePtsAttempts; // naujai prideti kintamieji

    function __construct(
        $name,
        $twoPtsPercentage,
        $threePtsPercentage,
        $twoPtsAttempts,
        $threePtsAttempts
    ) {
        $this->name = $name;
        $this->twoPtsPercentage = $twoPtsPercentage;
        $this->threePtsPercentage = $threePtsPercentage;
        $this->twoPtsAttempts = $twoPtsAttempts;
        $this->threePtsAttempts = $threePtsAttempts;
    }

    function shootTwoPointers()
    {
        $totalTwoPointers = 0;

        for ($i = 0; $i < $this->twoPtsAttempts; $i++) {
            $random = rand(1, 100);

            if ($this->twoPtsPercentage > $random) {
                $totalTwoPointers++;
            }
        }

        return $totalTwoPointers;
    }

    function shootThreePointers()
    {
        $totalThreePointers = 0;

        for ($i = 0; $i < $this->threePtsAttempts; $i++) {
            $random = rand(1, 100);

            if ($this->threePtsPercentage > $random) {
                $totalThreePointers++;
            }
        }

        return $totalThreePointers;
    }
}

class Team extends Database
{
    public $teamId;
    public $team;
    public $players = [];

    function __construct($teamId)
    {
        parent::__construct();
        $this->teamId = $teamId;
        $this->fetchPlayerInfo();
        $this->fetchTeamInfo();
    }

    function fetchTeamInfo()
    {
        $teamQuery = $this->pdo->prepare('SELECT * FROM team WHERE id=:id');
        $teamQuery->execute(['id' => $this->teamId]);
        $team = $teamQuery->fetch();

        $this->team = $team;
    }

    function fetchPlayerInfo()
    {
        $playerQuery = $this->pdo->prepare('SELECT * FROM basketball WHERE team_id = :teamId');
        $playerQuery->execute(['teamId' => $this->teamId]);

        $players = $playerQuery->fetchAll();

        foreach ($players as $player) {
            $this->players[] = new Player(
                $player['name'],
                $player['2pts_percentage'],
                $player['3pts_percentage'],
                $player['2pts_attempts'],
                $player['3pts_attempts']
            );
        }
    }
}

class Game extends Database
{
    public $time;
    public $team;
    public $totalTwoPointers = 0;
    public $totalThreePointers = 0;

    function __construct($team, $time)
    {
        parent::__construct();
        $this->team = $team;
        $this->time = $time;
    }


    function playGame()
    {
        $players = $this->team->players;

        foreach ($players as $player) {
            $this->totalTwoPointers += $player->shootTwoPointers();
            $this->totalThreePointers += $player->shootThreePointers();
        }

        $this->saveGame();
    }

    function saveGame()
    {
        $gameQuery = $this->pdo->prepare('INSERT INTO game SET game_time=:gameTime, team_id=:teamId, two_pts=:twoPts, three_pts=:threePts');
        $gameQuery->execute([
            'teamId' => $this->team->teamId,
            'twoPts' => $this->totalTwoPointers,
            'threePts' => $this->totalThreePointers,
            'gameTime' => $this->time
        ]);
    }

    function getLastGame()
    {
        $lastGameQuery = $this->pdo->prepare('SELECT *,
            three_pts * 3 AS points_from_three,
            two_pts * 2 AS points_from_two
        FROM game WHERE team_id=:teamId ORDER BY game_time DESC');

        $lastGameQuery->execute(['teamId' => $this->team->teamId]);

        return $lastGameQuery->fetch();
    }
}

$teamOne = new Team(1);
$teamTwo = new Team(2);

if (isset($_GET['action'])) {
    // $gameResult = $teamOne->playGame();
    // $gameResult2 = $teamTwo->playGame();
    $time = time();

    $gameResultOne = new Game($teamOne, $time);
    $gameResultTwo = new Game($teamTwo, $time);

    $resultOne = $gameResultOne->playGame();
    $resultTwo = $gameResultTwo->playGame();

    header("Location: ?page=basketball-mysql");
}

?>

<div class="row">
    <div class="col">
        <h1><?= $teamOne->team['name']; ?></h1>
        <ul class="list-group">
            <?php foreach ($teamOne->players as $player) { ?>
                <li class="list-group-item">
                    Žaidėjas: <?= $player->name; ?><br />
                    Dvitaškių taiklumas: <?= $player->twoPtsPercentage; ?>% (Per rungtynes: <?= $player->twoPtsAttempts; ?>)<br />
                    Tritaškių taiklumas: <?= $player->threePtsPercentage; ?>% (Per rungtynes: <?= $player->threePtsAttempts; ?>)
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="col">
        <ul class="list-group">
            <h1><?= $teamTwo->team['name']; ?></h1>
            <?php foreach ($teamTwo->players as $player) { ?>
                <li class="list-group-item">
                    Žaidėjas: <?= $player->name; ?><br />
                    Dvitaškių taiklumas: <?= $player->twoPtsPercentage; ?>% (Per rungtynes: <?= $player->twoPtsAttempts; ?>)<br />
                    Tritaškių taiklumas: <?= $player->threePtsPercentage; ?>% (Per rungtynes: <?= $player->threePtsAttempts; ?>)
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="col">
        <a href="?page=basketball-mysql&action=play" class="btn btn-primary">Zaisti zaidima</a>
    </div>
</div>
<hr />