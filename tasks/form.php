<?php

class Form
{
    public $formInputs;

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
