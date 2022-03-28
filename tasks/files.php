<?php

class FileManager
{
    public $filename;

    function __construct($filename)
    {
        $this->filename = $filename;
    }

    function readJsonToArray()
    {
        return json_decode(file_get_contents($this->filename), true);
    }

    function writeArrayToJson($data)
    {
        return file_put_contents($this->filename, json_encode($data));
    }
}
