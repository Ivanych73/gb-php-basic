<?php 
    require_once('head.php');
    require_once("config.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if ($_GET['id']) {
        $id = (int)$_GET['id'];
        $sql = "select catalog.title as goodTitle, description, price, images.pathbig, images.clicks, images.title AS imageTitle, images.id as imageId FROM `catalog` LEFT JOIN images ON images.good_id = catalog.id WHERE catalog.id = $id";
        $res = mysqli_query($connect, $sql);
        if(!$res) {
            die("Ошибка получения информации о товаре из базы данных!");
        }
        $good = mysqli_fetch_assoc($res);
        $imageSrc = $good['pathbig'].'\\'. $good['imageTitle'];
        if ($imageSrc == "\\") {
            $imageSrc = "img\small\\nophoto.png";
        }
        $sql = "update images set clicks = clicks +1 where id = {$good['imageId']}";
        $res = mysqli_query($connect, $sql);
        if(!$res) {
            die("Ошибка записи информации о товаре в базу данных!");
        }
    } else echo "Такой товар отсутствует в каталоге!";
?>
<div class = "container">
    <figure class="figure">
        <img src="<?= $imageSrc?>" class="figure-img img-fluid rounded" alt="">
        <h3 class="h3"><?= $good['goodTitle']?></h3>
        <p class = "lead"><?= $good['description']?></p>
        <p class = "small">Этот котик стоит <?= $good['price']?></p>
        <a class="btn btn-sm btn-outline-secondary" href="<?= ADD_TO_CART ?>?id=<?= $id ?>">Купить</a>
    </figure>
    <h3 class="display-6">Отзывы</h3>
    <div class="accordion" id="accordionExample">
        <?php
            $sql = "select reviewer, text from `reviews` where good_id = $id";
            $res = mysqli_query($connect, $sql);
            if(!$res) {
                die("Ошибка получения информации об отзывах из базы данных!");
            }
            while ($data = mysqli_fetch_assoc($res)) {
                $reviews[] = $data;
            }
            if (!$reviews) {
                echo "Здесь пока нет ни одного отзыва";
            } else {
                $reviews = array_reverse($reviews);
                foreach ($reviews as $value) {
                    $review = file_get_contents("templates/review.tpl");
                    $pattern = ['/{author}/', '/{text}/'];
                    $replacement = [$value['reviewer'], $value['text']];
                    echo preg_replace($pattern, $replacement, $review);
                }
            }
        ?>
    </div>
    <br>
    <br>
    <div class="mb-3">
        <a class="btn btn-primary" href = "<?=ADD_REVIEW_PAGE?>?id=<?=$id?>">Добавить отзыв</a>
    </div>

    <?php
        if($good['clicks']) 
            echo "Всего просмотров {$good['clicks']}<br>";
    ?>
</div>
<script src = "js/bootstrap.min.js"></script>
<?php require_once('close.php');?>