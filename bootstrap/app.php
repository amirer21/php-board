<?php
    date_default_timezone_set('Asia/Seoul');

    //error handling
    ini_set('display_errors', 'Off');

    //db connection
    $GLOBALS['DB_CONNECTION'] = mysqli_connect(
        'connect address',
        'username',
        'password',
        'database',
    ); //|| exit;

    //DB connection에 문제가 있으면 종료
    /*if(!$GLOBALS['DB_CONNCECION']){
        exit;
    }*/

    //모든 스크립트에 mysqli close를 하지않고 아래와 같이 mysql 종료
    register_shutdown_function(function(){
        if(array_key_exists('DB_CONNECTION', $GLOBALS) && $GLOBALS['DB_CONNECTION']){
            mysqli_close($GLOBALS['DB_CONNECTION']);
        }
    });

    ini_set('session.gc_maxlifetime', 1440);
    //session_set_cookie_params(1440);
    session_set_cookie_params(1440);
    session_start();    
?>