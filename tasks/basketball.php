<?php

include 'database.php';

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
    public $name;
    public $teamId;
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

        $this->name = $team['name'];
    }

    function fetchPlayerInfo()
    {
        $playerQuery = $this->pdo->prepare('SELECT * FROM basketball_start
            WHERE team_id=:teamId');
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

class Game extends Database
{
    public $team;
    public $time;
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
        foreach ($this->team->players as $player) {
            $this->totalTwoPointers += $player->shootTwoPointers();
            $this->totalThreePointers += $player->shootThreePointers();
        }
        $this->saveGame();
    }

    function saveGame()
    {
        $saveGameQuery = $this->pdo->prepare("INSERT INTO game SET
            team_id=:teamId,
            time=:time,
            2pts_made=:twoPointsMade,
            3pts_made=:threePtsMade
        ");
        $saveGameQuery->execute([
            'teamId' => $this->team->teamId,
            'time' => $this->time,
            'twoPointsMade' => $this->totalTwoPointers,
            'threePtsMade' => $this->totalThreePointers
        ]);
    }

    function getGame()
    {
        $getGameQuery = $this->pdo->prepare("SELECT * FROM game WHERE time=:time AND team_id=:teamId");
        $getGameQuery->execute([
            'time' => $this->time,
            'teamId' => $this->team->teamId
        ]);

        return $getGameQuery->fetch();
    }
}

$team = new Team(1);
$team2 = new Team(2);

if (isset($_GET['action'])) {
    $time = time();
    $game = new Game($team, $time);
    $game2 = new Game($team2, $time);

    $game->playGame();
    $game2->playGame();

    header('Location: ?page=basketball-mysql&game=' . $time);
}

?>

<div class="row">
    <div class="col">
        <h3><?= $team->name; ?></h3>
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

    <div class="col-1">
        <a href="?page=basketball-mysql&action=play" class="btn btn-primary">Zaisti</a>
    </div>

    <div class="col">
        <h3><?= $team2->name; ?></h3>
        <ul class="list-group">
            <?php foreach ($team2->players as $player) { ?>
                <li class="list-group-item">
                    Žaidėjas: <?= $player->name; ?><br />
                    Dvitaškių taiklumas: <?= $player->twoPtsPercentage; ?>% (Per rungtynes: <?= $player->twoPtsAttempts; ?>)<br />
                    Tritaškių taiklumas: <?= $player->threePtsPercentage; ?>% (Per rungtynes: <?= $player->threePtsAttempts; ?>)
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<hr />

<?php if (false && isset($gameResult)) { ?>
    <div class="row">
        <div class="col">
            <?php
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
            <?php } ?>
            <hr />
            <li class="list-group-item">Viso įmesta <?= $totalPoints; ?> taškų</li>
        </div>

        <div class="col">
            <?php
            $totalPoints2 = 0;

            foreach ($gameResult2 as $singlePerformance) {
                $totalPoints2 += $singlePerformance['2pts'] * 2;
                $totalPoints2 += $singlePerformance['3pts'] * 3;
            ?>
                <li class="list-group-item">
                    Žaidėjas: <?= $singlePerformance['name']; ?><br />
                    Įmesta dvitaškių: <?= $singlePerformance['2pts']; ?><br />
                    Įmesta tritaškių: <?= $singlePerformance['3pts']; ?>
                </li>
            <?php }
            ?>
            <hr />
            <li class="list-group-item">Viso įmesta <?= $totalPoints2; ?> taškų</li>
        <?php } ?>
        </div>
        <?php if (isset($_GET['game'])) {
            $gameResult = new Game($team, $_GET['game']);
            $gameResult2 = new Game($team2, $_GET['game']);

            $gameResultRecord = $gameResult->getGame();
            $game2ResultRecord = $gameResult2->getGame();
        ?>
            <div class="row">
                <div class="col">
                    <h3><?= $gameResult->team->name; ?></h3>
                    <h4><?= $gameResultRecord['2pts_made'] * 2 +
                            $gameResultRecord['3pts_made'] * 3; ?></h4>
                </div>

                <div class="col">
                    <h3><?= $gameResult2->team->name; ?></h3>
                    <h4><?= $game2ResultRecord['2pts_made'] * 2 +
                            $game2ResultRecord['3pts_made'] * 3; ?></h4>
                </div>
            </div>
        <?php } ?>
    </div>