<?php

require_once 'flutter_app.php';

$email = $_POST["email"];
$password = $_POST["password"];
$deviceId = $_POST["deviceId"];
$deviceOS = $_POST["deviceOS"];
//$email = "acb2@flutter.com";
//$password = "1234";
echo 'hello';
echo 'console.log("login")';
echo $email;
echo $password;
echo $deviceId;
echo $deviceOS;
//$_POST, $_GET 로 사용하면 안전하지 않으므로 다음과 같이 filter_input을 사용
//$email = filter_input(INPUT_POST, 'email');
//$password = filter_input(INPUT_POST, 'password');
//$token = filter_input(INPUT_POST, 'token');

    //if ($email && $password && hash_equals($token, $_SESSION['CSRF_TOKEN'])){
    if ($email && $password){
        //abc@naver.com -> abc
        //explode 배열값을 반환, current 배열의 첫번째 값을 가져온다.
        $username = current(explode('@', $email));
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($GLOBALS['DB_CONNECTION'], 
            'INSERT INTO users(email, password, username, deviceOS, deviceId) VALUES(?,?,?,?,?)'
            );

        mysqli_stmt_bind_param($stmt, 'sssss', $email, $password, $username, $deviceOS, $deviceId);

        if(mysqli_stmt_execute($stmt)){
            //session_unset();
            //session_destroy();
            //return header('Location: /auth/login.php');        
        } else {
            //return header('Location: /user/register.php');
        }
        mysqli_stmt_close($stmt);

    }
    //return header('Location: /user/register.php');
?>
