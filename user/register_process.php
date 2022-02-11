<?php

require_once dirname(__DIR__).'/bootstrap/app.php';

//$_POST, $_GET 로 사용하면 안전하지 않으므로 다음과 같이 filter_input을 사용
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$token = filter_input(INPUT_POST, 'token');

    if ($email && $password && hash_equals($token, $_SESSION['CSRF_TOKEN'])){
        
        //explode ('분할기준', 분할하려는문자)배열값을 반환, current 배열의 첫번째 값을 가져온다.
        //abc@naver.com -> abc
        $username = current(explode('@', $email));
        //password 해쉬화
        $password = password_hash($password, PASSWORD_DEFAULT);

        //statement
        $stmt = mysqli_prepare($GLOBALS['DB_CONNECTION'], 
            'INSERT INTO users(email, password, username) VALUES(?,?,?)'
            );

        //bind
        mysqli_stmt_bind_param($stmt, 'sss', $email, $password, $username);

        if(mysqli_stmt_execute($stmt)){
            session_unset(); //register가 되면 session 제거
            session_destroy();
            return header('Location: /auth/login.php'); //로그인 페이지로 이동       
        } else {
            return header('Location: /user/register.php'); //등록실패하면 다시 등록페이지로
        }
        mysqli_stmt_close($stmt);

    }
    return header('Location: /user/register.php');

?>