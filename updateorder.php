<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if(!$_COOKIE['isCustomer']  && !$_COOKIE['isAdmin']){
        $error = "Для изменения информации о заказе надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    }else {
        $newStatus = (int)$_GET['status'];
        $orderId = (int)$_GET['id'];
        if(!$newStatus || !$orderId) {
            $error = "Не указан ид заказа или новый статус";
            header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        }
        require_once('config.php');
        $sql = "update orders set status_id = $newStatus where id = $orderId";
        if(!$_COOKIE['isAdmin']) $sql .= " and user_id = {$_COOKIE['userId']}";
        $res = mysqli_query($connect, $sql);
        if(!$res) die("Ошибка обновления информации о заказе в базе данных!");
        else header("Location: {$_SERVER['HTTP_REFERER']}");
    }
?>