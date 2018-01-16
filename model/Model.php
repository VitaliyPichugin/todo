<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 16.01.2018
 * Time: 23:31
 */

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

        /* изменяем текущую базу данных на world */
        $this->db->select_db("todo");


        $this->db->close();

    }

}