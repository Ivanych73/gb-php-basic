<?php require_once('head.php'); ?>
<h1>Полноразмерное изображение</h1>
<?php
    require_once("config.php");
    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "select pathbig, title, clicks from images where id = $id";
        $res = mysqli_query($connect, $sql);
        $imageBig = mysqli_fetch_assoc($res);
        $imageSrc = $imageBig['pathbig'].'\\'. $imageBig['title'];
        $clicks = $imageBig['clicks'] + 1;
        $sql = "update images set clicks = $clicks where id = $id";
        $res = mysqli_query($connect, $sql);
    } else echo "Возникла проблема с отображением файла!<br>";
?>
<div class = "container">
    <figure class="figure">
    <img src="<?= $imageSrc?>" class="figure-img img-fluid rounded" alt="">
    </figure>
    <br>
    <?php
        if($clicks) 
            echo "Всего просмотров $clicks<br>";
        require_once("back.php");
    ?>
</div>
<?php require_once('close.php');?>