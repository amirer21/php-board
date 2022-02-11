<?php

require_once dirname(__DIR__).'/bootstrap/app.php';


//login되어 있어야된다
//array_key_exists $_SESSION배열에 'user'라는 키값이 있는지 확인
if(array_key_exists('user', $_SESSION)){
    $user = $_SESSION['user'];

    //read.php에서 가져오는 데이터는 id, token
    $token = filter_input(INPUT_GET, 'token');
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    //현재 로그인한 유저와 접근한 유저가 동일한지 확인
    if($id && hash_equals($token, $_SESSION['CSRF_TOKEN'])){
        $stmt = mysqli_prepare(
            $GLOBALS['DB_CONNECTION'],
            'SELECT * FROM posts WHERE id =?'
        );
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            ['user_id' => $userId] = mysqli_fetch_assoc($result);
        }
        mysqli_stmt_close($stmt);
    }
    if($user['id'] && isset($userId)){
        $stmt = mysqli_prepare(
            $GLOBALS['DB_CONNECTION'],
            'DELETE FROM posts WHERE id = ?'
        );
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if(mysqli_stmt_execute($stmt)){
            header('Location: /');
        }else{
            header('Location: /posts/read.php?id=' . $id);
        }
        return mysqli_stmt_close($stmt);
    }
    return header('Location: /posts/read.php?id=' . $id);
}

//로그인이 안되어 있다면 로그인 페이지로 이동
return header('Location: /auth/login.php');

?>