<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 21.01.2018
 * Time: 1:02
 */

class Archive extends ATodo {
    private $id;

    public function templateMethod()
    {
        $this->id = $this->con->getUserId();

        //  echo $this->getCntTask();
        return $this->render('index', 'template_archive.php', array(
            'project' => $this->getProject(),
            'task' => $this->getTaskGroup(),
            'priority' => $this->getPriority(),
            'title' => 'Archive'
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

}