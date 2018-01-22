<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 21.01.2018
 * Time: 1:02
 */

class Today extends ATodo
{
    private $id;

    public function templateMethod()
    {
        $this->id = $this->con->getUserId();
        $this->projectAdd();
        $this->taskAdd();
        return $this->render('template', 'today.php', array(
                'project' => $this->getProject(),
                'task' => $this->getTask(),
                'priority' => $this->getPriority()
            ));
    }

    function render($tenplate, $content, $data = null)
    {
        extract($data);
        ob_start();
        include('view/' . $tenplate . '.php');
        return ob_get_clean();
    }

    function getProject()
    {
        return $this->con->selectDatatUser($this->id, 'project');
    }

    function getTask()
    {
        return $this->con->selectDatatUser($this->id, 'task', date('d.m.Y'));
    }

    function userId()
    {
        return $this->con->getUserId();
    }

    function projectAdd(){
        if($_POST['addProject'] ){
            $this->con->addProject($this->id, $_POST['add_project'], $_POST['type']);
        }
    }

    function taskAdd(){
        if($_POST['addTask'] ){
            $this->con->addTask($this->id, $_POST['add_task'], $_POST['priority_id'], $_POST['project_id'], $_POST['date']);
        }
    }

    function getPriority(){
        return $this->con->selectDatatUser(null, 'priority');
    }




}