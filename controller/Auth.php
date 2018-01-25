<?php
/**
 * Created by PhpStorm.
 * User: Виталий
 * Date: 21.01.2018
 * Time: 1:31
 */

class Auth extends ATodo
{

    public function templateMethod()
    {
        $this->con = new Model(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->userLogin();
        $this->userRegistration();
        if($_SERVER['REQUEST_URI'] == '/auth/registration'){
            return $this->render('auth', 'registration.php');
        }else{
            return $this->render('auth', 'login.php');
        }
    }

    function render($tenplate, $content, $data=null)
    {
        // extract($data);
        ob_start();
        include('view/'.$tenplate.'.php');
        return ob_get_clean();
    }
    function userLogin()
    {
        if ($_POST['log'] == 'send_log') {
            if ($this->con->login($_POST['login'], $_POST['password'])) {
                $_SESSION['user']['login'] = $_POST['login'];
                $_SESSION['user']['password'] = $_POST['password'];
                $_SESSION['auth'] = true;
                header('Location: http://todo/');
            }
        }
    }
    function userRegistration(){
        if ($_POST['reg'] == 'send_reg') {
            if ($_POST['login_register'] && $_POST['pass_register'] == $_POST['re_pass_register']) {
                if ($this->con->registration($_POST['login_register'], $_POST['pass_register'])) {
                    $_SESSION['user']['login'] = $_POST['login'];
                    $_SESSION['user']['password'] = $_POST['password'];
                    $_SESSION['auth'] = true;
                    header('Location: http://todo/');
                }
            }
        }
    }


}