<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpblog <?=$_SERVER['REQUEST_URI']??''?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.20/dist/css/uikit.min.css">
    <link rel="stylesheet" href="../app.css">
</head>
<body>
    <div id="app">
        <main id="main" role="main">
            <nav id="nav" role="navigation" class="uk-navbar-container uk-navbar-transparent uk-padding uk-padding-remove-vertical uk-margin-bottom" uk-navbar>
            <div class = "uk-navbar-right">
            <!--로그인 여부에 따른 변화-->
                <ul class="uk-navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/user/register.php">Register</a></li>
                    <!--세션값이 있는 경우 보이는 부분-->
                    <?php if(array_key_exists('user', $_SESSION)) : ?>
                        <li><a href="/user/update.php">My page</a></li>
                        <li><a href="/post/write.php">Write</a></li>
                        <li><a href="/auth/logout.php">Sign out</a></li>
                    <!--세션값이 없는 경우 보이는 부분-->
                    <?php else: ?>
                        <li><a href="/auth/login.php">Sign in</a></li>
                    <?php endif; ?>
                    <?php echo '<script>';  ?>
                    <?php echo 'console.log("top")'; ?>
                    <?php echo '</script>';?>
                </ul>
            </div>
        </nav>