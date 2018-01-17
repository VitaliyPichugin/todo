<?php

 class Model
{
    public $db;

    public function __construct($host, $user, $pass, $db)
    {
        $this->db = new mysqli($host, $user, $pass, $db);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $this->db->select_db("todo");

        $this->db->close();

    }

}