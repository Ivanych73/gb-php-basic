<?php
    require_once('header.php');
    require_once('config.php');
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
?>
<div class="container">
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Корзина Ваших покупок</h1>

                <?php
                    if($_GET['error']):
                        $error = strip_tags(trim((string)$_GET['error']));
                ?>

                <div class="alert alert-warning" role="alert"><?= $error ?></div>

                <?php
                    endif;
                    if ($_GET['success']):
                        $success = strip_tags(trim((string)$_GET['success'])); 
                ?>

                <div class="alert alert-success" role="alert"><?= $success ?></div>

                <?php
                    endif;
                    $sql = "select good_id, quantity from cart where user_id = {$_COOKIE['userId']} and order_id is null";
                    $res = mysqli_query($connect, $sql);
                    if(!$res || !mysqli_num_rows($res)):
                ?>

                    <p class="lead">В Вашей корзине пока пусто</p>
            </div>
        </div>
    </section>

    <?php 
                    else: 
    ?>
            </div>
        </div>
    </section>
    <?php
            while ($data = mysqli_fetch_assoc($res)) {
                $goodsInCart[] = $data;
            }
            $sql = "select catalog.id as goodId, catalog.title as goodTitle, price, images.id as imageId, images.title as imageTitle, images.pathsmall FROM catalog LEFT JOIN images on images.good_id = catalog.id where catalog.id = {$goodsInCart[0]['good_id']}";
            for ($i = 1; $i < count($goodsInCart); $i++) {
                $sql .= " or catalog.id = {$goodsInCart[$i]['good_id']}";
            }
            $res = mysqli_query($connect, $sql);
            if(!$res) {
                die("Ошибка получения информации о товаре из базы данных!");
            }
            while ($data = mysqli_fetch_assoc($res)) {
                $goods[] = $data;
            }
            $goodsInCart = array_reverse($goodsInCart);
            for ($i = 0; $i < count($goodsInCart); $i++) {
                if($goods[$i]['imageTitle'] == "") {
                    $goods[$i]['imageTitle'] = "nophoto.png";
                    $goods[$i]['pathsmall'] = "img\\small";
                }
                $card = file_get_contents('templates\card.tpl');
                $pattern = [
                    '/{detailViewHref}/', 
                    '/{detailText}/',
                    '/{thumbnailPath}/',
                    '/{imgTitle}/',
                    '/{buyOrDelHref}/',
                    '/{buyOrDelText}/',
                    '/{goodTitle}/',
                    '/{price}/'
                ];
                $replacement = [
                    DETAIL_VIEW_PAGE."?id={$goods[$i]['goodId']}", 
                    "Подробнее об этом котике",
                    $goods[$i]['pathsmall'],
                    $goods[$i]['imageTitle'],
                    ADD_TO_CART."?id={$goods[$i]['goodId']}",
                    "Купить",
                    $goods[$i]['goodTitle'],
                    $goods[$i]['price']                
                ];
                $goodsInCart[$i]['card'] = preg_replace($pattern, $replacement, $card);
                $totalPrice += $goods[$i]['price'] * $goodsInCart[$i]['quantity'];
            }
            foreach($goodsInCart as $value) :
    ?>

    <div class="row py-2">
        <div class="col-4"><?=$value['card']?></div>
        <div class="col-4 d-flex justify-content-around align-items-center">
            <a class = "btn btn-secondary" href="<?= ADD_TO_CART ?>?id=<?=$value['good_id']?>">Добавить</a>
            <a class = "btn btn-secondary" href="<?= DELETE_FROM_CART ?>?id=<?=$value['good_id']?>">Удалить</a>
        </div>
        <div class="col-4 d-flex justify-content-center align-items-center">Всего:&nbsp<?=$value['quantity']?></div>
    </div>

    <?php
        endforeach;
        endif;    
    ?>
    <div class="d-flex w-50 py-5 justify-content-between">
        <?= "Общая стоимость корзины ".$totalPrice; ?>
        <a class = "btn btn-primary <?= !$totalPrice ? "d-none" : "" ?>" href="<?= EDIT_ORDER_PAGE ?>">Перейти к оформлению заказа</a>
    </div>
</div>
<?php require_once('footer.php')?>