<?php

abstract class ATodo extends Model
{
    protected $con;

    public function __construct()
    {
        $this->con = new Model(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    abstract public function templateMethod();

    abstract function render($tenplate, $content, $data=null);

}
