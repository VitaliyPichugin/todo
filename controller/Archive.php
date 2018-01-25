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

        return $this->render('index', 'template_archive.php', array(
            'project' => $this->getProject(),
            'task' => $this->getTaskGroup(),
            'priority' => $this->getPriority(),
            'title' => 'Archive',
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
        return $this->con->selectDatatUserArchive($this->id, 'project');
    }


    function userId()
    {
        return $this->con->getUserId();
    }

    function getPriority()
    {
        return $this->con->selectDatatUserArchive(null, 'priority');
    }

    function getCntTask()
    {
        return $this->con->countTaskArchive( $this->id);
    }

    function getTaskGroup()
    {
        if ($_GET['id']) {
            return $this->con->getGroupTaskArchive( $_GET['id'], $this->id);
        } else {
            return $this->con->selectDatatUserArchive($this->id, 'task', date('d.m.Y'));
        }
    }

    function getCntToday()
    {
        return $this->con->countTask( $this->id);
    }

    function getCntSevenDay()
    {
        return $this->con->countTaskSeven( $this->id);
    }

    function getCntArchive()
    {
        return $this->con->countTaskArchive( $this->id);
    }

}