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
        $this->id = $_SESSION['uid'];
        $this->projectAdd();
        $this->taskAdd();
        $this->delTask();
        $this->delProject();
        $this->doneTask();
        $this->editTask();
        $this->editProject();
        return $this->render('index', 'template.php', array(
            'project' => $this->getProject(),
            'task' => $this->getTaskGroup(),
            'priority' => $this->getPriority(),
            'expired' => $this->getExpiredTask(),
            'title' => 'Next 7 Day',
            'ctnTd' => $this->getCntToday(),
            'ctnSd' => $this->getCntSeven(),
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
        return $this->con->selectProject($this->id);
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
            $this->con->addTask($this->id, $_POST['add_task'], $_POST['priority_id'], $_POST['project_id'], $_POST['date'], $_POST['status']);
        }
    }

    function getPriority()
    {
        return $this->con->selectDatatUserSeven($this->id, 'priority');
    }

    function getCntToday()
    {
        return $this->con->countTask( $this->id);
    }

    function getCntSeven()
    {
        return $this->con->countTaskSeven( $this->id);
    }

    function getCntArchive()
    {
        return $this->con->countTaskArchive( $this->id);
    }

    function getTaskGroup()
    {
        if ($_GET['id']) {
            return $this->con->getGroupTaskSeven(date('d.m.Y'), $_GET['id'], $this->id);
        } else {
            return $this->con->selectDatatUserSeven($this->id, 'task', date('d.m.Y'));
        }
    }

    function getExpiredTask(){
        return $this->con->expiredTask($this->id);
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
            return $this->con->remove($_POST['del_id_project'], 'project');
        } else return false;
    }

    function doneTask(){
        if($_POST['done_id']){
            return $this->con->done($_POST['done_id']);
        }else return false;
    }

    function editTask(){
        if($_POST['send'] == 'task_edit'){
            return $this->con->edit(
                $_POST['edit_id'], $_POST['edit_task'], $_POST['project_id'], $_POST['priority_id'], $_POST['date'], $_POST['status']
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