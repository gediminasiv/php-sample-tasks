<?php

$array =
    [
        [
            'name' => 'Tadas',
            'age' => 23,
            'job' => 'Studentas'
        ],
        [
            'name' => 'Jonas',
            'age' => 33,
            'job' => 'Mechanikas'
        ],
        [
            'name' => 'Gabija',
            'age' => 27,
            'job' => 'Buhalterė',
        ],
        [
            'name' => 'Tomas',
            'age' => 48,
            'job' => 'Santechnikas',
        ],
        [
            'name' => 'Petras',
            'age' => 37,
            'job' => 'Vadybininkas'
        ],
        [
            'name' => 'Ieva',
            'age' => 31,
            'job' => 'Studentė',
        ],
        [
            'name' => 'Kęstutis',
            'age' => 30,
            'job' => 'Programuotojas'
        ]
    ];

$ageValue = isset($_POST['ageFrom']) ? $_POST['ageFrom'] : '';

?>

<div class="row">
    <div class="col">
        <form method="post">
            <div class="form-group">
                <label>Amžius nuo: </label>
                <input class="form-control" value="<?php echo $ageValue; ?>" name="ageFrom">
            </div>

            <button class="btn btn-primary" type="submit">Filtruoti</button>

            <a class="btn btn-primary" href="?page=homework_students&removeStudents">Išimti studentus</a>
        </form>
    </div>
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Vardas</th>
                    <th scope="col">Amžius</th>
                    <th scope="col">Profesija</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($array as $key => $people) { ?>
                    <?php if (isset($_GET['removeStudents']) && strpos($people['job'], 'Studen') !== false) continue; ?>
                    <?php if (isset($_POST['ageFrom']) && $_POST['ageFrom'] >= $people['age']) continue; ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $people['name']; ?></td>
                        <td><?php echo $people['age']; ?></td>
                        <td><?php echo $people['job']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
    </div>
</div>