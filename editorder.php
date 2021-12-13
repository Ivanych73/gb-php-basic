<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    require_once("header.php");
    if(!$_COOKIE['isCustomer']) :
        $error = "Для оформления заказа надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    else :
        require_once("config.php");
        $sql = "select name, email,  phone, address from users where id = {$_COOKIE['userId']}";
        $res = mysqli_query($connect, $sql);
        if (!$res) {
            $error = "Ошибка получения информации о пользователе из базы данных!";
            header("Location: ".CART_PAGE."?error=$error");
        } else {
            $user = mysqli_fetch_assoc($res);
        }
    $required = "required";
?>

    <div class="container">

        <form method="post" onsubmit="return validatePhpone()" action="/saveorder.php">
            <?php require_once('userfields.php'); ?>

            <div class="form-check">
                <input type="checkbox" name="saveCustomer" class="form-check-input" checked="true" id="remeberCheck">
                <label class="form-check-label" for="remeberCheck">Запомнить эти данные для следующих заказов</label>
            </div>

            <?php
                $sql = "select good_id, quantity from cart where user_id = {$_COOKIE['userId']} and order_id is null";
                $res = mysqli_query($connect, $sql);
                if(!$res || !mysqli_num_rows($res)):
            ?>
            <p class="lead">В Вашей корзине пусто, оформлять нечего!</p>
            <?php
                else:
                    while ($data = mysqli_fetch_assoc($res)) {
                        $goodsInCart[] = $data;
                    }
                endif;
                $sql = "select title, price, cart.quantity from catalog left join cart on catalog.id = cart.good_id where cart.order_id is null and (catalog.id = {$goodsInCart[0]['good_id']}";
                for ($i=1; $i<count($goodsInCart); $i++) {
                    $sql .= " or catalog.id = {$goodsInCart[$i]['good_id']}";
                }
                $sql .= ")";
                $res = mysqli_query($connect, $sql);
                if(!$res) {
                    die('Ошибка запроса к базе данных!');
                } else {
                    while($data = mysqli_fetch_assoc($res)) {
                        $data['subtotal'] = $data['price'] * $data['quantity'];
                        $goodsInOrder[] = $data;
                        $totalPrice += $data['subtotal'];
                    }
                }
            ?>
            <div class="lead">Детали заказа:</div>
            <div class="row py-2 w-75">
                <div class="col-4 fw-bold">Наименование товара</div>
                <div class="col-4 fw-bold">Количество</div>
                <div class="col-4 fw-bold">На сумму</div>
            </div>
            <?php
                foreach($goodsInOrder as $value) :
            ?>
            <div class="row py-2 w-75">
                <div class="col-4"><?= $value['title'] ?></div>
                <div class="col-4"><?= $value['quantity'] ?></div>
                <div class="col-4"><?= $value['subtotal'] ?></div>
            </div>
            <?php endforeach; ?>
            <div class="row py-2 w-75">
                <div class="col-4 fw-bold">Общая стоимость</div>
                <div class="col-4"></div>
                <div class="col-4 fw-bold"><?= $totalPrice ?></div>
            </div>
            <input type="hidden" name="totalprice" value="<?= $totalPrice ?>">
            <div class="form-group py-3">
                <label for="TextareaComments">Комментарии к заказу</label>
                <textarea name="comments" class="form-control w-50" id="TextareaComments" rows="3"></textarea>
            </div>
            <a class="btn btn-primary" href="<?= CART_PAGE ?>">Вернуться в корзину</a>
            <input type="submit" class="btn btn-primary" value="Оформить заказ">
        </form>

    </div>

<?php endif; ?>

<script src="js/validatephone.js"></script>

<?php require_once('footer.php'); ?>