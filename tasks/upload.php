<?php

$uploadedFilesInfo = file_get_contents('data/galerija.txt');

$uploadedFiles = explode("\n", $uploadedFilesInfo);

if (empty($uploadedFiles[0])) {
    $uploadedFiles = [];
}

if (isset($_FILES['fileToUpload'])) {
    $temporaryFile = $_FILES['fileToUpload'];

    $checkTypes = explode("/", $temporaryFile['type']);

    if ($checkTypes[0] !== 'image') {
?>
        <div class="alert alert-danger" role="alert">
            Ikeltas failas nera paveiksliukas...
        </div>
        <?php
    } else {
        if (file_exists('uploads/' . $temporaryFile['name'])) {
        ?>

            <div class="alert alert-danger" role="alert">
                Sis failas jau yra ikeltas
            </div>

        <?php
        } else {
            $filename = 'uploads/' . $temporaryFile['name'];
            move_uploaded_file($temporaryFile['tmp_name'], $filename);

            $caption = $_POST['caption'];

            $fileRow = $filename . "|" . $caption;

            $uploadedFiles[] = $fileRow;

            $uploadedFileString = implode("\n", $uploadedFiles);

            file_put_contents('data/galerija.txt', $uploadedFileString);
        ?>

            <div class="alert alert-success" role="alert">
                Sveikiname! Failas praejo visus patikrinimus ir dabar yra ikeltas!
            </div>

<?php }
    }
}
?>

<div class="row">
    <div class="col">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" />

            <div class="form-group">
                <input class="form-control" name="caption" placeholder="Image caption" />
            </div>

            <input type="submit" name="submit" value="Ikelti" class="btn btn-primary" />
        </form>
    </div>


    <div class="col">
        <?php if (count($uploadedFiles) > 0 && !empty($uploadedFiles[0])) { ?>
            <?php foreach ($uploadedFiles as $file) {
                $fileData = explode("|", $file);
                // $fileData = json_decode($file, true);

                if (!$fileData) {
                    continue; // apsaugom nuo netinkamu reiksmiu
                }
            ?>
                <img class="img-fluid" src="<?= $fileData[0]; ?>" alt="." />
                <p><?= $fileData[1]; ?></p>
            <?php }
        } else { ?>
            <div class="alert alert-warning">
                Galerijoje paveiksliuku nera
            </div>
        <?php } ?>
    </div>

</div>