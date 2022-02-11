<?php

require_once 'bootstrap/app.php';

$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$page = $page ? : 0; //default가 0

$stmt = mysqli_prepare(
    $GLOBALS['DB_CONNECTION'],
    'SELECT * FROM posts ORDER BY id DESC LIMIT 3 OFFSET ?'
);

$page = $page * 3;
mysqli_stmt_bind_param($stmt, 'i', $page);

if(mysqli_stmt_execute($stmt)){
    $result = mysqli_stmt_get_result($stmt);
    $posts = [];
    while ($row = mysqli_fetch_assoc($result)){
        array_push($posts, $row);
    }
}
mysqli_stmt_close($stmt);

//posts는 보여줄 게시판의 정보(게시제목, 유저이름, 시간, 게시글)를 보여주는데 필요한 데이터를 담는다.
$posts = array_map(function($post){
    $stmt = mysqli_prepare(
        $GLOBALS['DB_CONNECTION'],
        'SELECT * FROM users WHERE id = ?'
    );
    mysqli_stmt_bind_param($stmt, 'i', $post['user_id']);
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        ['username' => $username] = mysqli_fetch_assoc($result);
    }
    
    mysqli_stmt_close($stmt);

    // mb_substr 은 입력된 문자에서 원하는 위치에서 문자를 추출해서 반환 해주는 역할
    // strip_tags 문자열에서 HTML 태그와 PHP 태그 제거하는 함수
    $content = filter_var(mb_substr(strip_tags($post['content']), 0, 200), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //array_merge 배열끼리 합쳐서 새로운 배열을 생성해주는 함수
    $mappings = array_merge(
        //compact 변수와 그 값을 가지는 배열 생성
        compact('username', 'content'),
        [
            'created_at' => date('h:i A, M j', strtotime($post['created_at'])),
            'url' => '/post/read.php?id=' . $post['id']
        ]
    );
    return array_merge($post, $mappings);

}, $posts);


?>


<?php require_once 'layouts/top.php' ?>

<div id="main__index" class="uk-container">
    <ul class="uk-list">
        <!--foreach는 for문과 달리 배열을 사용할 수 있다 foreach ( 배열 as 키 => 값) 여기서 키는 생략가능-->
        <?php foreach ( $posts as $post) : ?>
        <li>
            <article class="uk-article">
                <h1 class="uk-article-title">
                    <!--게시글 제목 클릭하면 이동-->
                    <a href="<?=$post['url']?>" class="uk-link-reset">
                        <?=$post['title']?>
                    </a>
                </h1>
                <div class="uk-text-meta">by <?=$post['username']?></div>
                <p class="uk-maring"><?=$post['content']?></p>
                <div class="uk-text-meta"><?=$post['created_at']?></div>
            </article>
            <hr>
        </li>
        <?php endforeach; ?>
        <!--end-->
    </ul>
</div>
<!--app.js readmore 참고-->
<button id="readmore" class="uk-button uk-button-default">Read More</button>


<?php require_once 'layouts/bottom.php' ?>