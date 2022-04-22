<?php

class Form
{
    public $formInputs;

    function __construct($formInputs)
    {
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

    function generateSelectHtml($name, $placeholder, $values)
    {
        $selectHtml = '<select name="' . $name . '" class="form-control">';

        foreach ($values as $value) {
            $selectHtml .= '<option values="' . $value['id'] . '">' . $value['name'] . '</option>';
        }

        $selectHtml .= '</select>';

        return $selectHtml;
    }

    function generateFormHtml()
    {
        echo '<form method="post" enctype="multipart/form-data">';

        foreach ($this->formInputs as $formInput) {
            $class = isset($formInput['class']) ? $formInput['class'] : null;

            if ($formInput['type'] === 'select') {
                echo $this->generateSelectHtml($formInput['name'], $formInput['name'], []);
                continue;
            }

            echo $this->generateInputHtml($formInput['name'], $formInput['placeholder'], $class, $formInput['type']);
        }

        echo '<input type="submit" name="submit" value="Ikelti" class="btn btn-primary" /></form>';
    }
}
