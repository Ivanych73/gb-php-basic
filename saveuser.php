<?php
    require_once('config.php');
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    mysqli_set_charset($connect, "utf8mb4");
    $login = trim(strip_tags((string)$_POST['login']));
    $login = mysqli_real_escape_string($connect, $login);
    $sql = "select id from users where login = \"$login\"";
    $res = mysqli_query($connect, $sql);
    if(!$res) {
        die("Ошибка получения информации о пользователе из базы данных!");
    }
    if(mysqli_num_rows($res)) {
        $message = "Пользователь с таким логином уже существует, придумайте другой логин";
        header("Location: ".REGISTER_PAGE."?result=$message");
    } else {
        $pass = trim(strip_tags((string)$_POST['password']));
        $pass = mysqli_real_escape_string($connect, $pass);
        $letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        for ($i = 0; $i < 63; $i++) {
            $salt .= substr($letters, rand(0, 61), 1);
        }
        $pass = md5($pass.$salt);
        $sql = "insert into users (login, pass, is_customer, is_admin, salt) values (\"$login\", \"$pass\", 1, 0, \"$salt\")";
        $res = mysqli_query($connect, $sql);
        if($res) {
            $message = "Вы успешно зарегистрированы, как $login!";
        } else {
            $message = "Ошибка регистрации";
        }
        header("Location: ".REGISTER_PAGE."?result=$message");
    }

?>