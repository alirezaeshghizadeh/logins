<?php
//شروع نشست
session_name('panel');
session_start();

//منقضی کردن و حذف اطلاعات نشست
session_unset();
session_destroy();

//انتقال به صفحه ورود
header("Location: login.php");
exit;