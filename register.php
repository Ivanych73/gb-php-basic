<?php
    require_once('head.php');
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
?>

<div class="container">
    <h1 class="display-6">Регистрация нового пользователя</h1>
    <?php
        if($_GET['result']) :
    ?>
    <div class="alert alert-warning" role="alert">
        <?=trim(strip_tags((string)$_GET['result'])) ?>
    </div>
    <?php endif; ?>
    <form action="<?= SAVE_USER ?>" method="post">
        <div class="form-group row py-2">
            <label for="logininput" class = "col-3">Придумайте логин</label>
            <input type="text" name="login" id="logininput" class = "col-3" onkeyup = "verifyData()">
        </div>
        <div class="form-group row py-2">
            <label for="passwordinput1" class = "col-3">Придумайте пароль</label>
            <input type="password" name="password" id="passwordinput1" class = "col-3" onkeyup = "verifyData()">
        </div>
        <div class="form-group row py-2">
            <label for="passwordinput2" class = "col-3">Подтвердите пароль</label>
            <input type="password" name="confirmpassword" id="passwordinput2" class = "col-3" onkeyup = "verifyData()">
        </div>
        <div class="alert alert-warning" role="alert" id = "passwarning">
            Не указан пароль либо введенные пароли не совпадают!
        </div>
        <input class = "btn btn-primary" disabled = "true" type="submit" value="Зарегистрироваться" id="submitbutton">
    </form>
</div>
<script>

    const verifyData = () => {
        let elem = document.getElementById('logininput');
        let login = elem.value;
        elem = document.getElementById('passwordinput1');
        let pass1 = elem.value;
        elem = document.getElementById('passwordinput2');
        let pass2 = elem.value;
        if(pass1 == pass2 && login.length >= 1 && pass1.length >=1) {
            elem = document.getElementById('passwarning');
            elem.classList.add('d-none');
            elem = document.getElementById('submitbutton');
            elem.disabled = false;
        } else {
            elem = document.getElementById('passwarning');
            elem.classList.remove('d-none');
            elem = document.getElementById('submitbutton');
            elem.disabled = true;
        }
    }

</script>
<?php require_once('close.php');?>