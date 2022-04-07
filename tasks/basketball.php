<?php

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

class Team
{
    public $pdo;
    public $players = [];

    function __construct()
    {
        $this->pdo = new Pdo('mysql:host=localhost;dbname=codeacademy;user=root;password=root');
        $this->fetchPlayerInfo();
    }

    function fetchPlayerInfo()
    {
        $playerQuery = $this->pdo->query('SELECT * FROM basketball_start');

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

    function playGame()
    {
        $result = [];

        foreach ($this->players as $player) {
            $result[] = [
                'name' => $player->name,
                '2pts' => $player->shootTwoPointers(),
                '3pts' => $player->shootThreePointers()
            ];
        }

        return $result;
    }
}

$team = new Team();

if (isset($_GET['action'])) {
    $gameResult = $team->playGame();
}

?>

<div class="row">
    <div class="col">
        <ul class="list-group">
            <?php foreach ($team->players as $player) { ?>
                <li class="list-group-item">
                    Žaidėjas: <?= $player->name; ?><br />
                    Dvitaškių taiklumas: <?= $player->twoPtsPercentage; ?>% (Per rungtynes: <?= $player->twoPtsAttempts; ?>)<br />
                    Tritaškių taiklumas: <?= $player->threePtsPercentage; ?>% (Per rungtynes: <?= $player->threePtsAttempts; ?>)
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="col">
        <?php if (isset($gameResult)) {
            $totalPoints = 0;
            foreach ($gameResult as $singlePerformance) {
                $totalPoints += $singlePerformance['2pts'] * 2;
                $totalPoints += $singlePerformance['3pts'] * 3;
        ?>
                <li class="list-group-item">
                    Žaidėjas: <?= $singlePerformance['name']; ?><br />
                    Įmesta dvitaškių: <?= $singlePerformance['2pts']; ?><br />
                    Įmesta tritaškių: <?= $singlePerformance['3pts']; ?>
                </li>
            <?php }
            ?>
            <hr />
            <li class="list-group-item">Viso įmesta <?= $totalPoints; ?> taškų</li>

        <?php } ?>
        <a href="?page=basketball-mysql&action=play" class="btn btn-primary">Zaisti zaidima</a>
    </div>
</div>