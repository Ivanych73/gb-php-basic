<?php
    require_once('head.php');
    require_once('config.php');
    if ($_GET['id']) {
        $id = (int)$_GET['id'];
        $sql = "select catalog.title as goodTitle, description, price, images.title as imageTitle, images.pathbig from catalog left join images on images.good_id = catalog.id where catalog.id = $id";
        $res = mysqli_query($connect, $sql);
        $good = mysqli_fetch_assoc($res);
        $title = $good['goodTitle'];
        $price = $good['price'];
        $description = $good['description'];
        $imageSrc = $good['pathbig']."\\".$good['imageTitle'];
    } else {
        $title = "";
        $price = "";
        $description = "";
    }

    if ($_GET['result']) :
        $result = trim(strip_tags((string)$_GET['result']));
    ?>
    <p class="alert alert-warning"><?= $result?></p>

    <?php endif;?>

<div class = "container">
    <form action="savegood.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?= $id?>>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Название товара</label>
            <input type="text" class="form-control" name = "title" value = "<?= $title ?>" id="exampleFormControlInput1" placeholder="Новый товар">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Описание товара</label>
            <textarea class="form-control" name = "description" id="exampleFormControlTextarea1" rows="3"><?= $description ?></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Цена</label>
            <input type="number" class="form-control" name = "price" value = <?= $price ?> id="exampleFormControlInput2" placeholder="0">
        </div>
        <img src="<?= $imageSrc?>" id="output" alt="" height = 400>
        <div class="mb-3">
            <div id="fileHelp" class="form-text">Загрузить фото товара</div>
            <input type="file" accept = "image/gif, image/png, image/jpeg" name="photo" class="form-control" onchange=loadFile(event) id="exampleInputFile1" aria-describedby="fileHelp"><br><br>
        </div>
        <div class="mb-3">
            <div class = "btn-group">
                <input type="submit" class="btn btn-primary" value="Сохранить и закрыть">
                <input type="reset" class="btn btn-secondary" value="Отменить изменения">
                <a class="btn btn-primary" href="admin.php">Выйти без сохранения</a>
            </div>
        </div>
    </form>
</div>
<script>
    const loadFile = (event) => {
    const output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<?php
    require_once('close.php');
?>