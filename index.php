<? require_once 'config.php';
session_start();

spl_autoload_register(function ($file) {
    if(file_exists('controller/'.$file.'.php')){
        require_once 'controller/'.$file.'.php';
    }else if(file_exists('model/'.$file.'.php')) {
        require_once 'model/' . $file . '.php';
    }else{
        require_once 'view/' . $file . '.php';
    }
});

if($_SERVER['REQUEST_URI'] == '/logout'){
    session_destroy();
    header('Location: http://todo/');
}


if(!$_SESSION['auth']){
    $obj = new Auth();

    echo  $obj->templateMethod();
    $pattern1 = '/^\/[a-z]*\/$/';
    $pattern2 = '/^\/[a-z]*$/';

    exit;
}
else {

    switch ($_SERVER['REQUEST_URI']) {

        case '/today': {
            $obj = new Today();
            break;
        }
        case '/sevenday': {
            $obj = new Sevenday();
            break;
        }
        case '/archive': {
            $obj = new Archive();
            break;
        }
        case '/auth': {
            $obj = new Auth();
            break;
        }
        case '/auth/login': {
            $obj = new Auth();
            break;
        }
        case '/auth/registration': {
            $obj = new Auth();
            break;
        }
        default: {
            $obj = new Today();
            break;
        }
    }
}

echo $obj->templateMethod();


