<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    const STARTED = 1;
    if(!$_COOKIE['isAuthorized']) {
        $error = "Для оформления заказа надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    } else {        
        require_once('config.php');
        $today = date("Y-m-d");
        mysqli_set_charset($connect, "utf8mb4");
        //Предполагаем, что данные о пользователе, адресе и т.п., введенные при заказе, могут отличаться от
        //данных, указанных в личном кабинете пользователя
        $userName = strip_tags(trim((string)$_POST['name']));
        $userName = mysqli_real_escape_string($connect, $userName);
        if ($userName == "") $error .= "Некорректно указано имя пользователя!";
        $email = strip_tags(trim((string)$_POST['email']));
        $email = mysqli_real_escape_string($connect, $email);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        //Предполагаем, что email короче 1@1.ru не может быть
        if (strlen($email) < 6) $error .= " Некорректно указан email!";
        $phone = strip_tags(trim((string)$_POST['phone']));
        $phone = mysqli_real_escape_string($connect, $phone);
        $phone = str_replace("-", "", $phone);
        $phone = str_replace("+", "", $phone);
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        //Убрали из номера все кроме цифр, предполагаем что пользователи только из России
        if (strlen($phone) != 11) $error .= " Некорректно указан телефон!";
        $address = strip_tags(trim((string)$_POST['address']));
        $address = mysqli_real_escape_string($connect, $address);
        //Предполагаем что названий улиц короче 4 символов не может быть плюс пробел и номер дома
        if (strlen($address) < 6) $error .= " Некорректно указан адрес!";
        //Предполагаем, что цена товара в базе может меняться, но стоимость заказа должна быть зафикисрована на момент заказа
        $totalPrice = (int)$_POST['totalprice'];
        if(!$totalPrice) $error .= " Не указана стоиомсть заказа!";
        $comments = strip_tags(trim((string)$_POST['comments']));
        $comments = mysqli_real_escape_string($connect, $comments);
        if (!$error) {
            $sql = "insert into orders (user_id, status_id, date, total_price, name, email, phone, address, comments) values ({$_COOKIE['userId']}, ".STARTED.", \"$today\", $totalPrice, \"$userName\", \"$email\", \"$phone\", \"$address\", \"$comments\")";
            $res = mysqli_query($connect, $sql);
            if (!$res) {
                $error .= " Ошибка сохранения информации о заказе в базе данных!";
            } else {
                $sql = "select id from orders where user_id = {$_COOKIE['userId']} and status_id = ".STARTED." and date = \"$today\" order by id desc";
                $res = mysqli_query($connect, $sql);
                if (!$res) {
                    $error .= " Ошибка получения информации о заказе из базы данных!";
                } else {
                    $currentOrderId = mysqli_fetch_assoc($res)['id'];
                }                
            }
        }
        if(!$error) {
            $sql = "update cart set order_id = $currentOrderId where user_id = {$_COOKIE['userId']} and order_id is null";
            $res = mysqli_query($connect, $sql);
            if (!$res) $error .= " Ошибка обновления информации о заказе в базе данных!";
            else {
                $saveCustomer = (boolean)$_POST['saveCustomer'];
                if($saveCustomer) {
                    $sql = "update users set name = \"$userName\", phone = \"$phone\", email = \"$email\", address = \"$address\" where id = {$_COOKIE['userId']}";
                    $res = mysqli_query($connect, $sql);
                    if (!$res) $error .= " Ошибка обновления информации о пользователе в базе данных!";
                }
            }
        }
        if ($error) header("Location: ".CART_PAGE."?error=$error");
        else {
            $success="Заказ номер $currentOrderId успешно сохранен!";
            header("Location: ".CART_PAGE."?success=$success");
        }
    }
?>