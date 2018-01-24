<?php

 class Model
 {
     private $host;
     private $user;
     private $pass;
     private $db;
     private $con;
     private $from;
     private $to;

     public function __construct($host, $user, $pass, $db)
     {
         $this->host = $host;
         $this->user = $user;
         $this->pass = $pass;
         $this->db = $db;

         $this->from = date('d.m.Y', strtotime("+1 days"));
         $this->to = date('d.m.Y', strtotime("+7 days"));

         if (!$this->con) {
             $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);
             if ($this->con) {
                 $this->con->query('SET NAMES utf8');
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

     protected function selectDatatUser($id=null, $data, $date=null)
     {
         if($id != null && $date != null){
             $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                      AND `date` <='$date'  ORDER BY `priority_id` DESC");
         }else{
             $results = $this->con->query("SELECT * FROM $data");
         }
         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function selectDatatUserSeven($id=null, $data, $date=null)
     {
         if($id != null && $date != null){
             $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                      AND `date` BETWEEN '$this->from' AND '$this->to'  ORDER BY `priority_id` DESC");
         }else{
             $results = $this->con->query("SELECT * FROM $data");
         }
         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function getGroupTask($date, $idProject, $id){
         $results = $this->con->query("SELECT * FROM `task` WHERE `user_id` = $id 
                      AND `date` <='$date' AND `project_id` = $idProject ORDER BY `priority_id` DESC");
         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function getTaskSeven( $idProject, $id){
         $results = $this->con->query("SELECT * FROM `task` WHERE `user_id` = $id 
                      AND `date` BETWEEN '$this->from' AND '$this->to' AND `project_id` = $idProject ORDER BY `priority_id` DESC");
         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function getUserId()
     {
         $login = $_SESSION['user']['login'];
         $pass = $_SESSION['user']['password'];
         $results = $this->con->query("SELECT id FROM user WHERE login = '$login' AND password = '$pass' ");
         $res = $results->fetch_array();
         return $res[0];
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

     protected function addTask($userId, $nameTask, $priorityId, $projectId, $date){
         $stmt = $this->con->stmt_init();
         if(($stmt->prepare("INSERT INTO `task` (`user_id`, `name_task`, `priority_id`, `project_id`, `date`) 
                                  VALUES (?, ?, ?, ?, ?)") === FALSE)
             or ($stmt->bind_param('isiis', $userId, $nameTask, $priorityId, $projectId, $date) === FALSE)
             or ($stmt->execute() === FALSE)
         ) {
             die('Error (' . $stmt->errno . ') ' . $stmt->error);
         }else return true;
     }

     protected function countTask($date, $id){

         $results = $this->con->query("SELECT COUNT(1) FROM task WHERE `user_id` = $id AND `date` <='$date' ");
         $res = $results->fetch_array();
         return $res[0];
     }
     protected function countTaskSevenDay($date, $id){

         $results = $this->con->query("SELECT COUNT(1) FROM task WHERE `user_id` = $id AND `date` BETWEEN '$this->from' AND '$this->to'  ");
         $res = $results->fetch_array();
         return $res[0];
     }
     protected function countTaskArchive($id){

         $results = $this->con->query("SELECT COUNT(1) FROM task WHERE `user_id` = $id AND status = 'Done' ");
         $res = $results->fetch_array();
         return $res[0];
     }

     protected function done($id){
         $sql = "UPDATE `task` SET `status` = 'Done' WHERE `id` = $id";
         if($this->con->query($sql)){
             return true;
         }else return false;
      }

     protected function remove($id){
         $sql = "DELETE FROM `task` WHERE id = $id";
         if($this->con->query($sql)){
             return true;
         }else return false;
     }

     protected function edit($id, $name, $project_id, $priority_id, $date){
         $sql = "UPDATE `task` 
        SET `name_task` = $name, `project_id` = $project_id, `priority_id` = $priority_id, `date` = '$date'
        WHERE `id` = $id";
         if($this->con->query($sql)){
             return true;
         }else return false;
     }

     public function debug($arr){
         echo '<pre>';
         print_r($arr);
         echo '</pre>';
     }

}