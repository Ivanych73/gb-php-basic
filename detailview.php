<?php 
    require_once('head.php');
    require_once("back.php");
    require_once("config.php");
    if ($_GET['id']) {
        $id = (int)$_GET['id'];
        $sql = "select catalog.title as goodTitle, description, price, images.pathbig, images.clicks, images.title AS imageTitle, images.id as imageId FROM `catalog` LEFT JOIN images ON images.good_id = catalog.id WHERE catalog.id = $id";
        $res = mysqli_query($connect, $sql);
        $imageBig = mysqli_fetch_assoc($res);
        $imageSrc = $imageBig['pathbig'].'\\'. $imageBig['imageTitle'];
        if ($imageSrc == "\\") {
            $imageSrc = "img\small\\nophoto.png";
        }
        $sql = "update images set clicks = clicks +1 where id = {$imageBig['imageId']}";
        $res = mysqli_query($connect, $sql);
    } else echo "Возникла проблема с отображением файла!<br>";
?>
<div class = "container">
    <figure class="figure">
        <img src="<?= $imageSrc?>" class="figure-img img-fluid rounded" alt="">
        <h3 class="h3"><?= $imageBig['goodTitle']?></h3>
        <p class = "lead"><?= $imageBig['description']?></p>
        <p class = "small">Этот котик стоит <?= $imageBig['price']?></p>
        <a class="btn btn-sm btn-outline-secondary" href="#">Купить</a>
    </figure>
    <h3 class="display-6">Отзывы</h3>
    <div class="accordion" id="accordionExample">
        <?php
            $sql = "select reviewer, text from `reviews` where good_id = $id";
            $res = mysqli_query($connect, $sql);
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
        if($imageBig['clicks']) 
            echo "Всего просмотров {$imageBig['clicks']}<br>";
    ?>
</div>
<script src = "js/bootstrap.min.js"></script>
<?php require_once('close.php');?>