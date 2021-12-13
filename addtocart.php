<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if(!$_COOKIE['isCustomer']) {
        $error = "Для совершения или удаления покупок надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    } else {
        if(!$_GET['id']) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            require_once('config.php');
            $id = (int)$_GET['id'];
            $sql = "select quantity from cart where good_id = $id and user_id = {$_COOKIE['userId']} and order_id is null";
            $res = mysqli_query($connect, $sql);
            if(!$res) {
                die("Ошибка получения информации о товаре из базы данных!");
            }
            if (!mysqli_num_rows($res)) {
                $sql = "insert into cart (good_id, quantity, user_id) values ($id, 1, {$_COOKIE['userId']})";
            } else {
                $sql = "update cart set quantity = quantity +1 where good_id = $id and user_id = {$_COOKIE['userId']} and order_id is null";
            }
            //print_r($sql);
            $res = mysqli_query($connect, $sql);
            if(!$res) {
                die("Ошибка записи информации о товаре в базу данных!");
            }            
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
?>