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

         $this->from = date('d.m.Y', strtotime("+7 days"));
         $this->to = date('d.m.Y', strtotime("+7 days"));

         if (!$this->con) {
             $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);
             if ($this->con) {
                 $this->con->query('SET NAMES utf8');
             }
         }
     }

     //TODO CREATE SINGLES MODELS FOR SPECIFIC PAGES

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

     protected function selectDatatUser($id=null, $data, $date=null){
         if ($data == 'task') {
             if ($id != null && $date != null) {
                 $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                      AND `date` <= '$date' AND status = 'Not done'  ORDER BY `priority_id` DESC");
             } else {
                 $results = $this->con->query("SELECT * FROM $data AND status = 'Not done' ");
             }
             $res = [];
             while ($row = $results->fetch_array()) {
                 $res[] = $row;
             }
         } else {
             if ($id != null && $date != null) {
                 $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                      AND `date` = '$date' ORDER BY `priority_id` DESC");
             } else {
                 $results = $this->con->query("SELECT * FROM $data ");
             }
             $res = [];
             while ($row = $results->fetch_array()) {
                 $res[] = $row;
             }
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

     protected function getUserId(){
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

     protected function countTask( $id){
         $date = date('d.m.Y');
         $results = $this->con->query("SELECT COUNT(1) FROM task WHERE `user_id` = $id AND `date` <='$date' AND status = 'Not done' ");
         $res = $results->fetch_array();
         return $res[0];
     }

     protected function expiredTask($id){
         $date = date('d.m.Y');
         $results = $this->con->query("SELECT * FROM `task` WHERE `user_id` = $id 
                      AND `date` < '$date' AND status = 'Not done'  ORDER BY `priority_id` DESC");
         $res = [];
         while ($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function done($id){
         $sql = "UPDATE `task` SET `status` = 'Done' WHERE `id` = $id";
         if($this->con->query($sql)){
             return true;
         }else return false;
      }

     protected function remove($id, $table){
         if($table == 'project'){
             $count_task = $this->con->query("SELECT COUNT(1) FROM task WHERE `project_id` = $id AND `status` = 'Not done'")->fetch_array();
             if($count_task[0] == 0){
                 $del_task = "DELETE FROM `task` WHERE `project_id` = $id";
                 $sql = "DELETE FROM $table WHERE id = $id";
                 if ($this->con->query($del_task)) {
                     if ($this->con->query($sql)) {
                         return true;
                     } else return false;
                 }
             }else{
                 return false;
             }
         }else {
             $sql = "DELETE FROM $table WHERE id = $id";
             if ($this->con->query($sql)) {
                 return true;
             } else return false;
         }
     }

     protected function edit($id, $name, $project_id, $priority_id, $date){
          $stmt = $this->con->stmt_init();
         if(($stmt->prepare("UPDATE `task` SET `name_task` = ?, `project_id` = ?, `priority_id` = ?, `date` = ? WHERE `id` = ?") === FALSE)
             or ($stmt->bind_param('siisi', $name, $project_id, $priority_id, $date, $id) === FALSE)
             or ($stmt->execute() === FALSE)
         ) {
             die('Error (' . $stmt->errno . ') ' . $stmt->error);
         }else return true;
     }

     protected function editMenuProject($name, $type, $id){
         $stmt = $this->con->stmt_init();
         if(($stmt->prepare("UPDATE `project` SET `name_project` = ?, `type` = ? WHERE `id` = ?") === FALSE)
             or ($stmt->bind_param('ssi', $name, $type, $id) === FALSE)
             or ($stmt->execute() === FALSE)
         ) {
             die('Error (' . $stmt->errno . ') ' . $stmt->error);
         }else return true;
     }

     protected function selectDatatUserSeven($id=null, $data, $date=null){

         if ($data == 'task') {
             if($id != null && $date != null){
                 $results = $this->con->query("SELECT * FROM $data WHERE 
                DATE(`date`) BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL 5 DAY) 
                AND `user_id` = $id 
                      AND status = 'Not done'  ORDER BY `priority_id` DESC");
             }else{
                 $results = $this->con->query("SELECT * FROM $data AND status = 'Not done'");
             }
             $res = [];
             while($row = $results->fetch_array()) {
                 $res[] = $row;
             }
         } else {
             if ($id != null && $date != null) {
                 $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                      AND `date` BETWEEN '$this->from' AND '$this->to' ORDER BY `priority_id` DESC");
             } else {
                 $results = $this->con->query("SELECT * FROM $data ");
             }
             $res = [];
             while ($row = $results->fetch_array()) {
                 $res[] = $row;
             }
         }
         return $res;
     }

     protected function countTaskSevenDay( $id){
         $from = $this->from;
         $to = $this->from;
         $results = $this->con->query("SELECT COUNT(1) FROM task WHERE `user_id` = $id AND `date`
          BETWEEN '$from' AND '$to' AND status = 'Not done' ");
         $res = $results->fetch_array();
         return $res[0];
     }

     protected function getTaskSeven( $idProject, $id){
         $results = $this->con->query("SELECT * FROM `task` WHERE `user_id` = $id 
                      AND `date` BETWEEN '$this->from' AND '$this->to' AND `project_id` = $idProject AND status = 'Not done'
                       ORDER BY `priority_id` DESC");
         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function selectDatatUserArchive($id=null, $data, $date=null)
     {
         if ($data == 'task') {
             if($id != null && $date != null){
                 $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                       AND status = 'Done'  ORDER BY `priority_id` DESC");
             }else{
                 $results = $this->con->query("SELECT * FROM $data AND status = 'Done'");
             }
             $res = [];
             while($row = $results->fetch_array()) {
                 $res[] = $row;
             }
         } else {
             if ($id != null && $date != null) {
                 $results = $this->con->query("SELECT * FROM $data WHERE `user_id` = $id 
                      ORDER BY `priority_id` DESC");
             } else {
                 $results = $this->con->query("SELECT * FROM $data ");
             }
             $res = [];
             while ($row = $results->fetch_array()) {
                 $res[] = $row;
             }
         }
         return $res;
     }

     protected function getGroupTaskArchive( $idProject, $id){
         $results = $this->con->query("SELECT * FROM `task` WHERE `user_id` = $id 
                      AND `status` = 'Done' AND `project_id` = $idProject ORDER BY `priority_id` DESC");
         $res = [];
         while($row = $results->fetch_array()) {
             $res[] = $row;
         }
         return $res;
     }

     protected function countTaskArchive($id){
         $results = $this->con->query("SELECT COUNT(1) FROM task WHERE `user_id` = $id AND status = 'Done' ");
         $res = $results->fetch_array();
         return $res[0];
     }

}