<?php
    ///var/www/html/phpblog
    require_once dirname(__DIR__).'/bootstrap/app.php';
    //require_once '/var/www/html/phpblog/bootstrap/app.php';

    $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32));
    output_add_rewrite_var('token', $_SESSION['CSRF_TOKEN']);
    $session_echo = $_SESSION['CSRF_TOKEN'];
?>

<?php echo '<script>';  ?>
<?php echo 'console.log("login")'; ?>
<?php echo '</script>';?>
<?php echo "<script>console.log( 'PHP_Console: " . $session_echo . "' );</script>";?>

<?php
function Console_log($session_echo){
    echo "<script>console.log( 'PHP_Console: " . $session_echo . "' );</script>";
}
Console_log($session_echo);
?>

<?php require_once dirname(__DIR__).'/layouts/top.php';?>

<div id="main__form-auth" class="ck-padding uk-position-fixed uk-position-center">
    <!--<form action="/auth/login_process.php" method="POST">-->
    <form action="/auth/login_process.php" method="POST">
        <input type="text" name="email" placeholder="Email" class="uk-input">
        <input type="password" name="password" placeholder="Password" class="uk-input">
        <input type="submit" value="Submit" class="uk-button uk-button-default uk-width-1-1">
    </form>
</div>


<?php require_once dirname(__DIR__).'/layouts/bottom.php';?>
