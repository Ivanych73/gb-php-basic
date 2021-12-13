<?php
    require_once('header.php');
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
?>
    <div class="container">
        <?php
                if($_COOKIE['isAuthorized']) {
                    $message = "Вы успешно авторизованы, как ".$_COOKIE['userLogin'];
                } else {
                    $message = "Вы пока не авторизованы.";
                }
                if($_GET['error']) {
                    $message .= " ".strip_tags(trim((string)$_GET['error']));
                }
                echo $message;
        ?>
        <form action = "<?= SIGN_IN ?>" method = "post">
            <div class="form-group">
                <label for="inputLogin">Введите логин</label>
                <input type="text" class="form-control" name="login" id="inputLogin" aria-describedby="emailHelp" placeholder="Логин">
            </div>
            <div class="form-group">
                <label for="InputPassword1">Введите пароль</label>
                <input type="password" class="form-control" name="pass" id="InputPassword1" placeholder="Пароль">
            </div>
            <div class="btn-group">
                <input type="submit" class="btn btn-primary" value = "Войти">
                <a href="<?= SIGN_OUT ?>" class="btn btn-secondary">Выход</a>
            </div>
        </form>
    </div>
<?php
    require_once('footer.php');
?>