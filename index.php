<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require __DIR__ . '/vendor/autoload.php';
$config = require_once 'config.php';
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Mantis"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Access Denied';
    exit;
}elseif (isset($_REQUEST['key']) && $_REQUEST['key'] == $config['key']){
    $mantis = new Main($config['cookie']);
    $PATH = explode('/', $_SERVER['REQUEST_URI']);
    switch ($PATH[1])
    {
        case 'close_task':
            $mantis->closeTask();
            break;
        default:
            echo '';
            break;
    }
} else {
    if ($_SERVER['PHP_AUTH_USER'] == $config['user'] && $_SERVER['PHP_AUTH_PW'] == $config['password']){
        $mantis = new Main($config['cookie']);
        $PATH = explode('/', $_SERVER['REQUEST_URI']);
        switch ($PATH[1])
        {
            case 'tasks':
                echo $mantis->setFilterCookie()->getTasks();
                break;
            default:
                echo '';
                break;
        }
    }else{
        header('WWW-Authenticate: Basic realm="Mantis"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Access Denied';
        exit;
    }
}
//file_put_contents(time() . '.txt', json_encode($_REQUEST));

