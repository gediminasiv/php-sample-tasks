<?php

class MovieForm extends FileManager
{
    public $formInputs;

    function __construct($formInputs)
    {
        parent::__construct('data/filmai.json');
        $this->formInputs = $formInputs;
    }

    function processFormRequest($postData)
    {
        if (isset($postData['submit'])) {
            $filmJson = $this->readJsonToArray();

            $filename = 'uploads/' . $_FILES['fileToUpload']['name'];

            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filename);

            $newMovie = [
                'movieType' => $_POST['movieType'],
                'title' => $_POST['title'],
                'synopsis' => $_POST['synopsis'],
                'year' => $_POST['year'],
                'imageUrl' => $filename
            ];

            if ($_POST['movieType'] === 'cinema') {
                $newMovie['premiereDate'] = $_POST['date'];
                $newMovie['ticketPrice'] = $_POST['price'];
            } else {
                $newMovie['rentalDuration'] = $_POST['date'];
                $newMovie['rentalPrice'] = $_POST['price'];
            }

            $filmJson[] = $newMovie;

            $this->writeArrayToJson($filmJson);

            header('Location: /?page=movies');
        }
    }

    function generateInputHtml($name, $placeholder, $type = 'text')
    {
        if ($type === 'select') {
            return '<div class="form-group">
            <label for="exampleFormControlSelect1">' . $placeholder . '</label>
            <select name=' . $name . ' class="form-control" id="exampleFormControlSelect1">
              <option value="cinema">Kino filmas</option>
              <option value="rental">Videonuomos filmas</option>
            </select>
          </div>';
        }

        return '<div class="form-group">
        <input type=' . $type . ' class="form-control" name="' . $name . '" placeholder="' . $placeholder . '" />
        </div>';
    }

    function generateFormHtml()
    {
        echo '<form method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="fileToUpload" />';

        foreach ($this->formInputs as $formInput) {
            echo $this->generateInputHtml($formInput['name'], $formInput['placeholder'], $formInput['type']);
        }

        echo '<input type="submit" name="submit" value="Ikelti" class="btn btn-primary" /></form>';
    }
}
