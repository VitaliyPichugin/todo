<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 21.01.2018
 * Time: 1:02
 */

class Sevenday extends ATodo {

    private $id;

    public function templateMethod()
    {
        $this->id = $this->con->getUserId();
        $this->projectAdd();
        $this->taskAdd();
        $this->delTask();
        $this->delProject();
        $this->doneTask();
        $this->editTask();
        return $this->render('index', 'template.php', array(
            'project' => $this->getProject(),
            'task' => $this->getTaskGroup(),
            'priority' => $this->getPriority(),
            'title' => 'Next 7 Day',
            'ctnTd' => $this->getCntToday(),
            'ctnSd' => $this->getCntSevenDay(),
            'ctnAd' => $this->getCntArchive(),
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

    function getCntToday()
    {
        return $this->con->countTask( $this->id);
    }
    function getCntSevenDay()
    {
        return $this->con->countTaskSevenDay( $this->id);
    }
    function getCntArchive()
    {
        return $this->con->countTaskArchive( $this->id);
    }

    function getTaskGroup()
    {
        if ($_GET['id']) {
            return $this->con->getTaskSeven( $_GET['id'], $this->id);
        } else {
            return $this->con->selectDatatUserSeven($this->id, 'task', date('d.m.Y'));
        }
    }

    function delTask()
    {
        if ($_POST['del_id']) {
            return $this->con->remove($_POST['del_id'], 'task');
        } else return false;
    }

    function delProject()
    {
        if ($_POST['del_id_project']) {
            return $this->con->remove($_POST['del_id'], 'project');
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

    function editProject()
    {
        if ($_POST['send'] == 'project_edit_menu') {
            return $this->con->editMenuProject(
                $_POST['edit_project'], $_POST['type'], $_POST['edit_id_project']
            );
        }else return false;
    }

}