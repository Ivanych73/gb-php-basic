<?php
    const STARTED = 1;
    const IN_PROGRESS = 2;
    const IS_BEING_DELIVERED = 3;
    const SUCCESS = 4;
    const CANCELLED_BY_CLIENT = 5;
    const CANCELLED_BY_SHOP = 6;
    const ORDER_CLOSED = [SUCCESS, CANCELLED_BY_CLIENT, CANCELLED_BY_SHOP];
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if(!$_COOKIE['isCustomer']) :
        $error = "Для просмотра информации о заказах надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    else :
        require_once("config.php");
        require_once("header.php");
?>

<div class="container">
    <div class="display-6">
        Заказы пользователя <?= $_COOKIE['userLogin'] ?>
    </div>
    <div class="row py-2">
        <div class="col-2">Номер заказа</div>
        <div class="col-2">Сумма заказа</div>
        <div class="col-2">Дата заказа</div>
        <div class="col-2">Статус заказа</div>
        <div class="col-2">Подробнее о заказе</div>
        <div class="col-2">Отменить заказ</div>
    </div>
    <?php
        $sql = "select orders.id, date, total_price as totalPrice, status_id as statusId, order_statuses.status as orderStatus from orders left join order_statuses on orders.status_id = order_statuses.id where orders.user_id = {$_COOKIE['userId']}";
        $res = mysqli_query($connect, $sql);
        if (!$res) die("Ошибка получения информации о заказах из базы данных!");
        else {
            while ($data = mysqli_fetch_assoc($res)){
                $orders[] = $data;
            }
        }
        $status = CANCELLED_BY_CLIENT;
        require_once('ordersfiltered.php');
    ?>
</div>

<?php
    endif;
?>

<?php
    require_once('footer.php');
?>