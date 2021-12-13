<?php
    require_once('header.php');
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
?>
<div class = "container">
    <form action="<?= SAVE_REVIEW ?>" method = "post">
        <input type="hidden" name="id" value=<?= (int)$_GET['id']?>>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Представтесь</label>
            <input type="text" class="form-control" name = "author" id="exampleFormControlInput1" placeholder="Имя Фамилия">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ваш отзыв</label>
            <textarea class="form-control" name = "text" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class = "btn-group">
            <button type="submit" class="btn btn-primary">Сохранить отзыв</button>
            <a class="btn btn-primary"href="<?= DETAIL_VIEW_PAGE ?>?id=<?= (int)$_GET['id']?>">Отмена</a>
        </div>
    </form>
</div>
<?php require_once('footer.php');?>