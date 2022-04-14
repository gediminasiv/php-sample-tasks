<?php

class Form extends Database
{
    public $formInputs;

    function __construct($formInputs)
    {
        parent::__construct();

        $this->formInputs = $formInputs;
    }

    function generateInputHtml($name, $placeholder, $class, $type = 'text')
    {
        if ($type === 'select') {
            return '<div class="form-group ' . $class . '">
            <label for="exampleFormControlSelect1">' . $placeholder . '</label>
            <select name=' . $name . ' class="form-control" id="exampleFormControlSelect1">
              <option value="cinema">Kino filmas</option>
              <option value="rental">Videonuomos filmas</option>
            </select>
          </div><br />';
        }

        return '<div class="form-group ' . $class . '">
        <label>' . $placeholder . '</label>
        <input type=' . $type . ' class="form-control" name="' . $name . '" placeholder="' . $placeholder . '" />
        </div><br />';
    }

    function generateFormHtml()
    {
        echo '<form method="post" enctype="multipart/form-data">';

        foreach ($this->formInputs as $formInput) {
            $class = isset($formInput['class']) ? $formInput['class'] : null;

            echo $this->generateInputHtml($formInput['name'], $formInput['placeholder'], $class, $formInput['type']);
        }

        echo '<input type="submit" name="submit" value="Ikelti" class="btn btn-primary" /></form>';
    }
}

class MovieForm extends Form
{
    function __construct($formInputs)
    {
        parent::__construct($formInputs);
    }

    function processFormRequest($postData)
    {
        if (isset($postData['submit'])) {
            $filename = 'uploads/' . $_FILES['fileToUpload']['name'];

            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filename);

            $newMovie = [
                'type' => $_POST['type'],
                'title' => $_POST['title'],
                'synopsis' => $_POST['synopsis'],
                'year' => $_POST['year'],
                'imageUrl' => $filename,
                'premiereDate' => null,
                'ticketPrice' => null,
                'rentalDuration' => null,
                'rentalPrice' => null
            ];

            if ($_POST['type'] === 'cinema') {
                $newMovie['premiereDate'] = $_POST['premiereDate'];
                $newMovie['ticketPrice'] = $_POST['ticketPrice'];
            } else {
                $newMovie['rentalDuration'] = $_POST['rentalDuration'];
                $newMovie['rentalPrice'] = $_POST['rentalPrice'];
            }

            $createMovieQuery = $this->pdo->prepare("INSERT INTO movies SET
            type=:type,
            title=:title,
            synopsis=:synopsis,
            year=:year,
            imageUrl=:imageUrl,
            premiereDate=:premiereDate,
            ticketPrice=:ticketPrice,
            rentalDuration=:rentalDuration,
            rentalPrice=:rentalPrice
            ");
            $createMovieQuery->execute($newMovie);

            header('Location: /?page=movies');
        }
    }
}
