<?php
if(!isset($check)){
$text = null;
$username = null;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>رود کاربر</title>

<style>
body{
font-family:Tahoma, Geneva, sans-serif;
direction:rtl;
font-size:12px;
line-height: 22px;
}
.error{
height: 30px;
width: 100%;
color: #dd000a;
}
</style>
</head>
<body>
<?php echo $text; ?>
<form action="login.php" method="post">
<label for="user">نام کاربری:</label>
<input name="username" id="user" type="text" value="<?php echo $username; ?>" maxlength="255" dir="ltr">
<label for="pass">کلمه عبور:</label>
<input name="password" id="pass" type="password" maxlength="255" dir="ltr">
<input name="check" type="hidden" value="1">
<input type="submit" value="ورود به پنل">
</form>
<hr>
- قبل از ورود کاربر به پنل مدیریت سایت ابتدا باید اطلاعات اتصال به دیتابیس را در فایل config.php در آرایه config تعریف کرده باشیم، نام کاربری در لوکال هاست معمولا root و بدون کلمه عبور است.<br>
- اجرای صحیح این کد مستلزم ساخت دیتابیس، جدول، ستون ها و درج نمونه اطلاعاتی است که در آموزش نحوه ساخت فرم عضویت سایت توضیح داده ایم (در صورتی که این آموزش را مطالعه نکرده اید لطفا به بخش آموزش های کاربردی MySQL مراجعه کنید).<br>
- دقت کنیم برای رمزنگاری کلمه عبور در مرحله عضویت کاربر از تابع password_hash استفاده کرده ایم، این تابع از نسخه PHP 5.5 در دسترس است، برای سازگاری نسخه های قدیمی تر کتابخه password_compat به کدها اضافه شده است.<br>
</body>
</html>