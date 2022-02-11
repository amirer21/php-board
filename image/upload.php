<?php
require_once dirname(__DIR__).'/bootstrap/app.php';

if(array_key_exists('user', $_SESSION)){
    $user = $_SESSION['user'];
    $file = $_FILES['upload']; //파일 upload 필드
    $filename = $user['id'] . "_" . time() . "_" . hash('md5', $file['name']); //파일명
    $accepts = [
        'png',
        'jpg'
    ]; //파일형식
    $pathParts = pathinfo($file['name']);

    if(in_array($pathParts['extension'], $accepts) && is_uploaded_file($file['tmp_name'])){
        $path = dirname(__DIR__) . '/uploads/' . $filename; //업로드 폴더 지정
        if(move_uploaded_file($file['tmp_name'], $path)){
            echo json_encode([
                'uploaded' => 1,
                'url' => '/uploads/?id=' . $filename
            ]);
            return http_response_code(200);
        }
    }
}
return http_response_code(400);
?>
