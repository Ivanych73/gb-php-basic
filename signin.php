<?php

    function errorAuth($error) {
        setcookie("isAuthorized", false, time() - 3600);
        setcookie("isCustomer", false, time() - 3600);
        setcookie("isAdmin", false, time() - 3600);
        setcookie("userId", false, time() - 3600);
        setcookie("userLogin", false, time() - 3600);
        header("Location: ".AUTH_PAGE."?error=$error");
    }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    require_once('config.php');
    mysqli_set_charset($connect, "utf8mb4");
    $login = trim(strip_tags((string)$_POST['login']));
    $login = mysqli_real_escape_string($connect, $login);
    $pass = trim(strip_tags((string)$_POST['pass']));
    $pass = mysqli_real_escape_string($connect, $pass);
    $sql = "select id, is_customer, is_admin, login, pass, salt from users where login = \"$login\"";
    $res = mysqli_query($connect, $sql);
    if(!$res) {
        die("Ошибка получения информации о пользователе из базы данных!");
    }
    if (!mysqli_num_rows($res)) {
        errorAuth("Такой пользователь не зарегистрирован, пожалуйста зарегистрируйтесь.");
    } else {
        $user = mysqli_fetch_assoc($res);
        $pass = md5($pass.$user['salt']);
        if($user['pass'] != $pass) {
            errorAuth("Неверный пароль, попробуйте еще раз.");
        } else {
            setcookie("isAuthorized", true);
            setcookie("isCustomer", $user['is_customer']);
            setcookie("isAdmin", $user['is_admin']);
            setcookie("userId", $user['id']);
            setcookie("userLogin", $user['login']);
            header("Location: ".AUTH_PAGE);
        }
    }
?>