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
        $this->delTask();
        $this->doneTask();
        $this->editTask();
        //  echo $this->getCntTask();
        return $this->render('index', 'template.php', array(
            'project' => $this->getProject(),
            'task' => $this->getTaskGroup(),
            'priority' => $this->getPriority(),
            'title' => 'Today'
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

    /*    function getTask()
        {
            return $this->con->selectDatatUser($this->id, 'task', date('d.m.Y'));
        }*/

    function userId()
    {
        return $this->con->getUserId();
    }

    function projectAdd()
    {
        if ($_POST['addProject']) {
            $this->con->addProject($this->id, $_POST['add_project'], $_POST['type']);
        }
    }

    function taskAdd()
    {
        if ($_POST['addTask']) {
            $this->con->addTask($this->id, $_POST['add_task'], $_POST['priority_id'], $_POST['project_id'], $_POST['date']);
        }
    }

    function getPriority()
    {
        return $this->con->selectDatatUser(null, 'priority');
    }

    function getCntTask()
    {
        return $this->con->countTask(date('d.m.Y'), $this->id);
    }

    function getTaskGroup()
    {
        if ($_GET['id']) {
            return $this->con->getGroupTask(date('d.m.Y'), $_GET['id'], $this->id);
        } else {
            return $this->con->selectDatatUser($this->id, 'task', date('d.m.Y'));
        }
    }

    function delTask()
    {
        if ($_POST['del_id']) {
            return $this->con->remove($_POST['del_id']);
        } else return false;
    }

    function doneTask(){
        if($_POST['done_id']){
            return $this->con->done($_POST['done_id']);
        }else return false;
    }

    function editTask(){
        if($_POST['task_edit']){
            return $this->con->edit(
                $_POST['edit_id'], $_POST['edit_task'], $_POST['project_id'], $_POST['priority_id'], $_POST['date']
            );
        }else return false;
    }


}