<?php
//شروع نشست
session_name('panel');
session_start();

//بررسی متغیرهای نشست
if(isset($_SESSION['access']) && $_SESSION['access'] === true) {
    echo 'Welcome To Control Panel!<br>User Name: ' . $_SESSION['user'];
    echo '&nbsp;[<a href="logout.php" title="Logout">Logout</a>]';
} else {
    header("HTTP/1.1 403 Forbidden");
    echo 'HTTP 403 Forbidden – Access Denied!';
    exit;
}