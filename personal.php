<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if(!$_COOKIE['isCustomer']) :
        $error = "Для редактирования личной информации надо сначала авторизоваться.";
        header("Location: ".AUTH_PAGE."?error=$error");
    else :
        require_once("config.php");
        $sql = "select name, email,  phone, address from users where id = {$_COOKIE['userId']}";
        $res = mysqli_query($connect, $sql);
        if (!$res) :
            $error = "Ошибка получения информации о пользователе из базы данных!";
            header("Location: ".AUTH_PAGE."?error=$error");
        else :
            $user = mysqli_fetch_assoc($res);
            require_once('header.php');
            $required = "";
?>

<div class="container">
    <form action="updateuser.php" method="post" onsubmit="return validatePhpone()">

        <?php require_once('userfields.php'); ?>
        <input type="submit" class="btn btn-primary" value="Сохранить данные">
    </form>
<?php 
        endif; 
    endif;
    if($_GET['error']):
        $error = strip_tags(trim((string)$_GET['error']));
?>

    <div class="alert alert-warning my-2 w-75" role="alert"><?= $error ?></div>

<?php
    endif;
    if ($_GET['success']):
        $success = strip_tags(trim((string)$_GET['success'])); 
?>

    <div class="alert alert-success my-2 w-75" role="alert"><?= $success ?></div>
<?php endif; ?>
</div>
<script src="js/validatephone.js"></script>
<?php
    require_once('footer.php');
?>