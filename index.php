<?php
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
    switch ($PATH)
    {
        case 'close_task':
            $mantis->closeTask();
            break;
        default:
            echo '';
            break;
    }
    //TODO
} else {
    if ($_SERVER['PHP_AUTH_USER'] == $config['user'] && $_SERVER['PHP_AUTH_PW'] == $config['password']){
        $mantis = new Main($config['cookie']);
        $PATH = explode('/', $_SERVER['REQUEST_URI']);
        switch ($PATH)
        {
            case 'tasks':
                echo $mantis->setFilterCookie()->getTasks();
                break;
            default:
                echo '';
                break;
        }

        //echo '{"tasks":[{"id":"0000885","updated":"2019-11-01","summary":"\u041a\u0430\u0447\u0435\u0441\u0442\u0432\u043e \u0444\u043e\u0442\u043e\u0433\u0440\u0430\u0444\u0438\u0439","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000885","description":"","created":"","closed":false},{"id":"0000859","updated":"2019-10-29","summary":"RFQ \u043d\u0435 \u0440\u0430\u0431\u043e\u0442\u0430\u044e\u0442 \u0441\u0441\u044b\u043b\u043a\u0438","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000859","description":"","created":"","closed":false},{"id":"0000830","updated":"2019-10-25","summary":"test","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000830","description":"","created":"","closed":false},{"id":"0000680","updated":"2019-10-08","summary":"\u0428\u0430\u0431\u043b\u043e\u043d\u044b \u043f\u0438\u0441\u0435\u043c","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000680","description":"","created":"","closed":false},{"id":"0000369","updated":"2019-09-24","summary":"1","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000369","description":"","created":"","closed":false},{"id":"0000398","updated":"2019-09-24","summary":"\u041c\u0430\u0441\u043a\u0430 \u0432\u0432\u043e\u0434\u0430 \u0442\u0435\u043b\u0435\u0444\u043e\u043d\u0430","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000398","description":"","created":"","closed":false},{"id":"0000399","updated":"2019-09-24","summary":"\u0432 \u0430\u0434\u0440\u0435\u0441\u0435 \u0432\u0435\u0440\u043d\u0443\u0442\u044c \u0440\u0430\u0439\u043e\u043d","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000399","description":"","created":"","closed":false},{"id":"0000400","updated":"2019-09-24","summary":"\u0420\u0435\u0433\u0438\u043e\u043d \u043f\u043e \u0447\u0430\u0441\u043e\u0432\u044b\u043c \u043f\u043e\u044f\u0441\u0430\u043c","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000400","description":"","created":"","closed":false},{"id":"0000553","updated":"2019-09-11","summary":"\u041f\u0438\u0441\u044c\u043c\u043e \u0441\u043e \u0441\u0442\u0430\u0442\u0438\u0441\u0442\u0438\u043a\u043e\u0439 GRT, \u043d\u0435 \u0441\u043e\u0434\u0435\u0440\u0436\u0438\u0442 \u0441\u0441\u044b\u043b\u043e\u043a \u043d\u0430 \u043d\u0435\u043e\u0431\u0440\u0430\u0431\u043e\u0442\u0430\u043d\u043d\u044b\u0435 \u0442\u043e\u0432\u0430\u0440\u044b","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000553","description":"","created":"","closed":false},{"id":"0000949","updated":"2019-11-25","summary":"\u0414\u043e\u0441\u0442\u0430\u0432\u043a\u0430: \u041f\u0440\u0438\u0437\u043d\u0430\u043a \u0442\u043e\u0432\u0430\u0440\u0430","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000949","description":"","created":"","closed":false},{"id":"0000858","updated":"2019-10-29","summary":"\u041e\u0442\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u0435 \u0446\u0435\u043d \u043d\u0430 \u0441\u0430\u0431 \u0441\u0430\u0439\u0442\u0430\u0445","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000858","description":"","created":"","closed":false},{"id":"0000310","updated":"2019-09-11","summary":"\u0424\u0438\u043b\u044c\u0442\u0440\u0430\u0446\u0438\u044f \u0432 \u043a\u0430\u043b\u0435\u043d\u0434\u0430\u0440\u0435 \u043c\u0435\u0440\u043e\u043f\u0440\u0438\u044f\u0442\u0438\u0439","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000310","description":"","created":"","closed":false},{"id":"0000571","updated":"2019-09-11","summary":"\u043e\u043f\u043e\u0432\u0435\u0449\u0435\u043d\u0438\u0435 \u043e \u043f\u0440\u0438\u0447\u0438\u043d\u0430\u0445 \u043e\u0442\u043a\u0430\u0437\u0430 \u0432 \u0430\u0432\u0442\u043e\u0440\u0438\u0437\u0430\u0446\u0438\u0438","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000571","description":"","created":"","closed":false},{"id":"0000516","updated":"2019-09-11","summary":"\u041e\u043f\u043e\u0432\u0435\u0449\u0435\u043d\u0438\u0435 \u043e \u043d\u0435\u043f\u0440\u043e\u0445\u043e\u0436\u0434\u0435\u043d\u0438\u0438 \u043f\u0440\u043e\u0432\u0435\u0440\u043a\u0438 \u043a\u043e\u043c\u043f\u0430\u043d\u0438\u044f\u043c","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000516","description":"","created":"","closed":false},{"id":"0000955","updated":"2019-11-27","summary":"\u0418\u0437\u043c\u0435\u043d\u0435\u043d\u0438\u0435 \u0432\u043d\u0435\u0448\u043d\u0435\u0433\u043e \u0432\u0438\u0434\u0430 \u0446\u0435\u043d \u0442\u043e\u0432\u0430\u0440\u043e\u0432, \u043a\u043e\u0442\u043e\u0440\u044b\u0435 \u043f\u0440\u043e\u0434\u0430\u0451\u0442 GRT","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000955","description":"","created":"","closed":false},{"id":"0000929","updated":"2019-11-18","summary":"b2c \u0432 \u0430\u0434\u043c\u0438\u043d\u043a\u0435","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000929","description":"","created":"","closed":false},{"id":"0000917","updated":"2019-11-12","summary":"\u041f\u0435\u0440\u0435\u0440\u0430\u0431\u043e\u0442\u043a\u0430 \u043a\u043e\u0440\u0437\u0438\u043d\u044b","issueUrl":"https:\/\/mantis.globalrustrade.com\/view.php?id=0000917","description":"","created":"","closed":false}]}';
    }else{
        header('WWW-Authenticate: Basic realm="Mantis"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Access Denied';
        exit;
    }
}
//file_put_contents(time() . '.txt', json_encode($_REQUEST));

