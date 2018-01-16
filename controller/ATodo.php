<?php

//require_once '../model/Model.php';
require_once '../model/Model.php';
abstract class ATodo extends Model
{
    public function __construct()
    {
        $this->db = new mysqli('localhost', 'mysql', '1111', 'todo');

    }

    abstract public function templateMethod();

}

class Today extends ATodo {
    public function templateMethod()
    {
        // TODO: Implement templateMethod() method.
    }
}

class SevenDay extends ATodo {
    public function templateMethod()
    {
        // TODO: Implement templateMethod() method.
    }
}