<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    const STARTED = 1;
    const IN_PROGRESS = 2;
    const IS_BEING_DELIVERED = 3;
    const SUCCESS = 4;
    const CANCELLED_BY_CLIENT = 5;
    const CANCELLED_BY_SHOP = 6;
    const ORDER_CLOSED = [SUCCESS, CANCELLED_BY_CLIENT, CANCELLED_BY_SHOP];
    if(!$_COOKIE['isAdmin']) :
        $error = "Для просмотра информации о заказах надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    else :
        require_once("header.php");
        require_once('config.php');
        mysqli_set_charset($connect, "utf8mb4");
        if($_POST['ordersfrom']) {
            $ordersFrom = trim(strip_tags((string)$_POST['ordersfrom']));
            $ordersFrom = mysqli_real_escape_string($connect, $ordersFrom);
        }
        if($_POST['ordersto']) {
            $ordersTo = trim(strip_tags((string)$_POST['ordersto']));
            $ordersTo = mysqli_real_escape_string($connect, $ordersTo);
        }
        if($_POST['pricefrom']) {
            $priceFrom = (int)$_POST['pricefrom'];
        }
        if($_POST['priceto']) {
            $priceTo = (int)$_POST['priceto'];
        }
        if($_POST['statusid'] && is_array($_POST['statusid'])) {
            foreach($_POST['statusid'] as $value) {
                $statusId[] = (int)$value;
            }
        } else $statusId = [];
?>

    <div class="container">
        <div class="display-4">Управление заказами</div>
        <form action="" method="post">
            <div class="lead">Отфильтовать заказы</div>
            <div class="mb3">
                <label for="dateFrom" class="form-label">Созданы с:</label>
                <input type="date" class="w-25 my-1" name="ordersfrom" value="<?= $ordersFrom ?>" id="dateFrom">
                <label for="dateTo" class="form-label">Созданы по:</label>
                <input type="date" class="w-25 my-1" name="ordersto" value="<?= $ordersTo ?>" id="dateTo">
            </div>
            <div class="mb-3">
                <label for="priceFrom" class="form-label">Стоимость от:</label>
                <input type="number" class="w-25 my-1" name="pricefrom" value="<?= $priceFrom ?>" id="priceFrom">
                <label for="priceTo" class="form-label">Стоимость до:</label>
                <input type="number" class="w-25 my-1" name="priceto" value="<?= $priceTo ?>" id="priceTo">
            </div>
            <label for="status" class="form-label">Статус заказа</label>
            <select name="statusid[]" multiple id="status" class="form-control w-25 my-1">
                    <option 
                        value="<?= STARTED ?>"
                        <?= (in_array(STARTED, $statusId)) ? "selected" : "" ?>
                    >
                        Принят в работу
                    </option>
                    <option
                        value="<?= IN_PROGRESS ?>"
                        <?= (in_array(IN_PROGRESS, $statusId)) ? "selected" : "" ?>
                    >
                        Обрабатывается            
                    </option>
                    <option
                        value="<?= IS_BEING_DELIVERED ?>"
                        <?= (in_array(IS_BEING_DELIVERED, $statusId)) ? "selected" : "" ?>
                    >
                        Передан в службу доставки
                    </option>
                    <option
                        value="<?= SUCCESS ?>"
                        <?= (in_array(SUCCESS, $statusId)) ? "selected" : "" ?>
                    >
                        Успешно завершен
                    </option>
                    <option
                        value="<?= CANCELLED_BY_CLIENT ?>"
                        <?= (in_array(CANCELLED_BY_CLIENT, $statusId)) ? "selected" : "" ?>
                    >
                        Отменен клиентом                
                    </option>
                    <option
                        value="<?= CANCELLED_BY_SHOP ?>"
                        <?= (in_array(CANCELLED_BY_SHOP, $statusId)) ? "selected" : "" ?>
                    >
                        Отменен магазином
                    </option>
                </select>
            <input type="submit" class="btn btn-primary my-2" value="Показать заказы">
            <a class="btn btn-secondary my-2" href="manageorders.php">Очистить фильтр</a>
        </form>

        <?php
            if(!$_COOKIE['isAdmin']) {
                $error = "Для входа в панель управления надо сначала авторизоваться как администратор.";
                header("Location: ".AUTH_PAGE."?error=$error");
            } else {
                $sql = "select orders.id, date, total_price as totalPrice, status_id as statusId, order_statuses.status as orderStatus from orders left join order_statuses on orders.status_id = order_statuses.id where ";
                if ($statusId && is_array($statusId)) {
                    $filterStatus = "(status_id = {$statusId[0]}";
                    for ($i=1; $i<count($statusId); $i++) {
                        $filterStatus .= " or status_id = {$statusId[$i]}";
                    }
                    $filterStatus .= ")";
                    $sql .= $filterStatus;
                } else $sql .= "1";
                if($ordersFrom) $sql .= " and date >= \"$ordersFrom\"";
                if($ordersTo) $sql .= " and date < \"$ordersTo\"";
                if($priceFrom) $sql .= " and total_price >= $priceFrom";
                if($priceTo) $sql .= " and total_price < $priceTo";
                $res = mysqli_query($connect, $sql);
                if(!$res) {
                    echo "По такому запросу ничего не найдено, либо произошла ошибка получения информации о заказах из базы данных!";
                }
                while ($data = mysqli_fetch_assoc($res)) {
                    $orders[] = $data;
                }
            }
        ?>
            <div class="row py-2">
            <div class="col-2">Номер заказа</div>
            <div class="col-2">Сумма заказа</div>
            <div class="col-2">Дата заказа</div>
            <div class="col-2">Статус заказа</div>
            <div class="col-2">Подробнее о заказе</div>
            <div class="col-2">Отменить заказ</div>

<?php
        $status = CANCELLED_BY_SHOP;
        require_once('ordersfiltered.php');
    endif;
?>

    </div>

<?php require_once('footer.php');