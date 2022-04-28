<?php
//شروع نشست
session_name('panel');
session_start();

//پیش فرض
$_SESSION['access'] = false;
$_SESSION['user'] = null;
$error = 0;
$text = null;

//فایل تنظیمات اتصال به دیتابیس
include_once('config.php');

//تعریف توابع کلمه عبور در نسخه های پائین تر از PHP 5.5
if(!function_exists('password_hash')) {
    include_once('lib/password_compat.php');
}

//دریافت و تعریف متغیرها
@$username = $_POST['username'];
@$password = $_POST['password'];
@$check = $_POST['check'];

/* بررسی معتبر بودن اطلاعات ارسالی کاربر در صورت ارسال فرم */
if($check == 1) {
    //نام کاربری
    if(!isset($username) || empty($username)) {
        $error = 1;
        $text = "نام کاربری خود را وارد کنید!";
    } //کلمه عبور
    elseif(!isset($password) || empty($password)) {
        $error = 1;
        $text = "کلمه عبور خود را وارد کنید!";
    }

    //بررسی خطا
    if($error === 0) {
        //اتصال به دیتابیس
        $conn = mysqli_connect($config['host'], $config['db_user'], $config['db_pass'], $config['db_name']);

        if(!$conn) {
            echo "PHP & MySQL Connection: Error! " . mysqli_connect_errno() . ' - ' . mysqli_connect_error();
            exit;
        } else {
            //ایمن سازی پارامترها
            $username = mysqli_real_escape_string($conn, $username);

            //نام جدول
            $tbl_name = "users";

            //اانتخاب اطلاعات از جدول و ستون
            $sql = "SELECT `password` FROM $tbl_name WHERE `username` = '$username' LIMIT 1";
            $query = mysqli_query($conn, $sql);

            if(!$query) {
                echo "Selecting From Table $tbl_name: Error! " . mysqli_error($conn) . '<br>';
            } else {
                //تعداد ردیف های انتخاب شده
                $count = mysqli_num_rows($query);

                if($count === 0) {
                    $error = 1;
                    $text = "نام کاربری یا کلمه عبور اشتباه است!";
                } else {
                    while($row = mysqli_fetch_array($query)) {
                        $db_hashed_password = $row['password'];

                        //تطبیق کلمه عبور
                        if(password_verify($password, $db_hashed_password)) {
                            $_SESSION['access'] = true;
                            $_SESSION['user'] = $username;
                            header("Location: panel.php");
                            exit;
                        } else {
                            $error = 1;
                            $text = "نام کاربری یا کلمه عبور اشتباه است!";
                        }
                    }
                }
            }
        }

        //پایان اتصال
        mysqli_close($conn);
    }
}

//بارگذاری مجدد فرم ورود در صورت بروز خطا یا فراخوانی مجدد
if($check != 1 || $error == 1) {
    if($error == 1) {
        $text = '<div class="error">' . $text . '</div>';
    }

    include_once('index.php');
}
