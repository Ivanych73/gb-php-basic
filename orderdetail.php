<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    const STARTED = 1;
    const IN_PROGRESS = 2;
    const IS_BEING_DELIVERED = 3;
    const SUCCESS = 4;
    const CANCELLED_BY_CLIENT = 5;
    const CANCELLED_BY_SHOP = 6;
    const ORDER_CLOSED = [SUCCESS, CANCELLED_BY_CLIENT, CANCELLED_BY_SHOP];
    if(!$_COOKIE['isCustomer']) :
        $error = "Для просмотра информации о заказах надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    else :
        require_once("config.php");
        require_once("header.php");
        $orderId = (int)$_GET['id'];
        if(!$orderId) {
            $error = "Не указан ид заказа";
            header("Location: {$_SERVER['HTTP_REFERER']}?error=$error");
        }
        $sql = "select orders.id, status_id as statusId, date, total_price as totalPrice, name, email, phone, address, comments, order_statuses.status from orders left join order_statuses on order_statuses.id = orders.status_id where orders.id = $orderId";
        $res = mysqli_query($connect, $sql);
        if(!$res) die("Ошибка получения информации о заказе из базы данных!");
        else {
            $order = mysqli_fetch_assoc($res);
        }
        $sql = "select quantity, catalog.title from cart left join catalog on cart.good_id = catalog.id where cart.order_id = $orderId";
        $res = mysqli_query($connect, $sql);
        if(!$res) die("Ошибка получения информации о товарах из базы данных!");
        else {
            while ($data = mysqli_fetch_assoc($res)) {
                $goodsInOrder[] = $data;
            }
        }
        $order['goodsInOrder'] = $goodsInOrder;
?>

<div class="container">
        <div class="row py-2">
            <div class="col-4">Номер заказа</div>
            <div class="col-4"><?= $order['id'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-4">Дата заказа</div>
            <div class="col-4"><?= $order['date'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-6">Информация о заказчике</div>
        </div>
        <div class="row py-2">
            <div class="col-1"></div>
            <div class="col-4">Имя</div>
            <div class="col-4"><?= $order['name'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-1"></div>
            <div class="col-4">Электронная почта</div>
            <div class="col-4"><?= $order['email'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-1"></div>
            <div class="col-4">Телефон</div>
            <div class="col-4"><?= $order['phone'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-1"></div>
            <div class="col-4">Адрес доставки</div>
            <div class="col-4"><?= $order['address'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-6">Состав заказа</div>
        </div>
        <div class="row py-2">
            <div class="col-1"></div>
            <div class="col-4">Наименование товара</div>
            <div class="col-4">Количество</div>
        </div>
        <?php
            foreach($order['goodsInOrder'] as $value) :
        ?>
        <div class="row py-2">
            <div class="col-1"></div>
            <div class="col-4"><?= $value['title'] ?></div>
            <div class="col-4"><?= $value['quantity'] ?></div>
        </div>
        <?php endforeach; ?>
        <div class="row py-2">
            <div class="col-4">Общая стоимость</div>
            <div class="col-4"><?= $order['totalPrice'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-4">Статус заказа</div>
            <div class="col-4"><?= $order['status'] ?></div>
        </div>
        <div class="row py-2">
            <div class="col-4">Комментарии к заказу</div>
            <div class="col-4"><?= $order['comments'] ?></div>
        </div>
        <?php
            if(!in_array($order['statusId'], ORDER_CLOSED)): 
                echo "Заказ доступен для редактирования!";
                if(!$_COOKIE['isAdmin']) :
        ?>

        <a 
            href="updateorder.php?id=<?= $order['id'] ?>&status=<?= CANCELLED_BY_CLIENT ?>"
            class="btn btn-secondary">
            Отменить заказ № <?= $order['id'] ?>
        </a>

        <?php
            else:
        ?>

        <form action="updateorder.php" method="get">
            <label for="orderstatus">Установить новый статус заказа</label>
            <select name="status" id="orderstatus">
                <option 
                    value="<?= STARTED ?>"
                    <?= ($order['statusId'] == STARTED) ? "selected" : "" ?>
                >
                    Принят в работу
                </option>
                <option
                    value="<?= IN_PROGRESS ?>"
                    <?= ($order['statusId'] == IN_PROGRESS) ? "selected" : "" ?>
                >
                    Обрабатывается            
                </option>
                <option
                    value="<?= IS_BEING_DELIVERED ?>"
                    <?= ($order['statusId'] == IS_BEING_DELIVERED) ? "selected" : "" ?>
                >
                    Передан в службу доставки
                </option>
                <option value="<?= SUCCESS ?>">Успешно завершен</option>
                <option value="<?= CANCELLED_BY_CLIENT ?>">Отменен клиентом</option>
                <option value="<?= CANCELLED_BY_SHOP ?>">Отменен магазином</option>
            </select>
            <input type="hidden" name="id" value="<?= $order['id'] ?>">
            <input type="submit" class="btn btn-primary" value="Сохранить новый статус заказа">
        </form>

        <?php
                endif;
            else :
                echo "Заказ закрыт и недоступен для редактирования!";
            endif;
        ?>
</div>

<?php
    endif;
    require_once('footer.php');
?>