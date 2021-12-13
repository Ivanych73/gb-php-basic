<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if(!$_COOKIE['isCustomer']){
        $error = "Для сохранения личной информации надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    }else {
        require_once("config.php");        
        mysqli_set_charset($connect, "utf8mb4");
        $userName = strip_tags(trim((string)$_POST['name']));
        $userName = mysqli_real_escape_string($connect, $userName);
        if ($userName == "") $error .= "Некорректно указано имя пользователя!";
        $email = strip_tags(trim((string)$_POST['email']));
        $email = mysqli_real_escape_string($connect, $email);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (strlen($email) < 6) $error .= " Некорректно указан email!";
        $phone = strip_tags(trim((string)$_POST['phone']));
        $phone = mysqli_real_escape_string($connect, $phone);
        $phone = str_replace("-", "", $phone);
        $phone = str_replace("+", "", $phone);
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        if (strlen($phone) != 11) $error .= " Некорректно указан телефон!";
        $address = strip_tags(trim((string)$_POST['address']));
        $address = mysqli_real_escape_string($connect, $address);
        if (strlen($address) < 6) $error .= " Некорректно указан адрес!";
        if(!$error) {
            $sql = "update users set name = \"$userName\", phone = \"$phone\", email = \"$email\", address = \"$address\" where id = {$_COOKIE['userId']}";
            $res = mysqli_query($connect, $sql);
            if (!$res) $error .= " Ошибка обновления информации о пользователе в базе данных!";
        }
        if ($error) header("Location: personal.php?error=$error");
        else {
            $success="Данные пользователя успешно обновлены!";
            header("Location: personal.php?success=$success");
        }
    }
?>