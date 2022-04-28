<?php

class Form
{
    public $formInputs;
    public $id;

    function __construct($formInputs)
    {
        $this->formInputs = $formInputs;
    }

    function generateInputHtml($name, $placeholder, $class, $type = 'text')
    {
        return '<div class="form-group ' . $class . '">
        <label>' . $placeholder . '</label>
        <input type=' . $type . ' class="form-control" name="' . $name . '" placeholder="' . $placeholder . '" />
        </div><br />';
    }

    function generateTextareaHtml($name, $placeholder)
    {
        return '<div class="form-group">
            <label>' . $placeholder . '</label>
            <textarea class="form-control" name="' . $name . '"></textarea>
        </div>';
    }

    function generateSelectHtml($name, $placeholder, $values)
    {
        $selectHtml = '<div class="form-group">';
        $selectHtml .= '<label>' . $placeholder . '</label>';
        $selectHtml .= '<select name="' . $name . '" class="form-control">';
        $selectHtml .= '<option disabled selected value="">' . $placeholder . '</option>';

        foreach ($values as $value) {
            $selectHtml .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }

        $selectHtml .= '</select></div>';

        return $selectHtml;
    }

    function generateFormHtml()
    {
        echo '<form method="post" enctype="multipart/form-data" id="' . $this->id . '">';

        foreach ($this->formInputs as $formInput) {
            $class = isset($formInput['class']) ? $formInput['class'] : null;

            if ($formInput['type'] === 'select') {
                echo $this->generateSelectHtml($formInput['name'], $formInput['placeholder'], $formInput['values']);
                continue;
            }

            if ($formInput['type'] === 'text') {
                echo $this->generateTextareaHtml($formInput['name'], $formInput['placeholder']);
                continue;
            }

            echo $this->generateInputHtml($formInput['name'], $formInput['placeholder'], $class, $formInput['type']);
        }

        echo '<input type="submit" name="submit" value="Ikelti" class="btn btn-primary" /></form>';
    }
}
