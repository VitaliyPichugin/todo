<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 21.01.2018
 * Time: 1:02
 */

class Sevenday extends ATodo {

    public function templateMethod()
    {
        return $this->render('template', 'sevenday.php');
    }

    function render($tenplate, $content, $data=null)
    {
       // extract($data);
        ob_start();
        include('view/'.$tenplate.'.php');
        return ob_get_clean();
    }
}