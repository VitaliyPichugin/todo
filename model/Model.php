<?php

 class Model
 {
     private $host;
     private $user;
     private $pass;
     private $db;
     private $con;

     public function __construct($host, $user, $pass, $db)
     {
         $this->host = $host;
         $this->user = $user;
         $this->pass = $pass;
         $this->db = $db;

         if (!$this->con) {
             $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);
             if ($this->con) {
                 $this->con->query('SET NAMES utf8');
                // return $this->con;
             }
         }
     }

     protected function select(){
         $stmt = $this->con->stmt_init();
         if(($stmt->prepare("SELECT * FROM user ") === FALSE)
                 or ($stmt->execute() === FALSE)
                 or (($result = $stmt->get_result()) === FALSE)
                 or ($stmt->close() === FALSE)
        ) {
             die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
         }
        return $result->fetch_all();
     }

     protected function login($login, $pass){

         $stmt = $this->con->stmt_init();
         if(($stmt->prepare("SELECT * FROM user WHERE login = ? AND password = ?") === FALSE)
             or ($stmt->bind_param('ss', $login, $pass) === FALSE)
             or ($stmt->execute() === FALSE)
             or (($result = $stmt->get_result()) === FALSE)
             or ($stmt->close() === FALSE)
         ) {
             die('Login Error (' . $stmt->errno . ') ' . $stmt->error);
         }
         return $result->fetch_assoc();
     }

     protected function registration($login, $pass){
         $stmt = $this->con->stmt_init();
         if(($stmt->prepare("INSERT INTO `user` (`login`, `password`) VALUES (?, ?)") === FALSE)
             or ($stmt->bind_param('ss', $login, $pass) === FALSE)
             or ($stmt->execute() === FALSE)
         ) {
             die('Reg Error (' . $stmt->errno . ') ' . $stmt->error);
         }else return true;
     }

     protected function selectDatatUser($id=null, $data)
     {
         if($id != null){
             $results = $this->con->query("SELECT * FROM $data WHERE user_id =".$id);
         }else{
             $results = $this->con->query("SELECT * FROM $data");
         }

         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;

         }
         return $res;
     }

     protected function addProject($userId, $projectName, $type){
         $stmt = $this->con->stmt_init();
         if(($stmt->prepare("INSERT INTO `project` (`user_id`, `name_project`, `type`) VALUES (?, ?, ?)") === FALSE)
             or ($stmt->bind_param('iss', $userId, $projectName, $type) === FALSE)
             or ($stmt->execute() === FALSE)
         ) {
             die('Error (' . $stmt->errno . ') ' . $stmt->error);
         }else return true;
     }

     protected function getUserId()
     {
         $login = $_SESSION['user']['login'];
         $pass = $_SESSION['user']['password'];
         $results = $this->con->query("SELECT id FROM user WHERE login = '$login' AND password = '$pass' ");
         $res = $results->fetch_array();
         return $res[0];
     }

     protected function addTask(){

     }


     public function debug($arr){
         echo '<pre>';
         print_r($arr);
         echo '</pre>';
     }

}