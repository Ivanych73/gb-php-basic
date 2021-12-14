<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");?>
<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img class="bi me-2" width="40" src = "img/logo.png">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
          <li><a href="<?= CART_PAGE ?>" class="nav-link px-2 text-white">Корзина</a></li>
        </ul>

        <div class="text-end">
          <?php
            if($_COOKIE['isAuthorized']) {
              $loginHrefValue = "Выход";
              $loginHref = SIGN_OUT;
              $loginMessage = "Вы вошли, как {$_COOKIE['userLogin']}";
              $displayNone = " d-none";
            } else {
              $loginHrefValue = "Войти";
              $loginHref = AUTH_PAGE;
              $loginMessage = "Вы пока не авторизованы";
              unset($displayNone);
            }
            if($_COOKIE['isAdmin']) {
              $adminDisplayNone = "";
            } else {
              $adminDisplayNone = " d-none";
            }
          ?>
          <p class="text-muted"><?=$loginMessage ?></p>
          <a class="btn btn-outline-light me-2" href = <?= $loginHref ?>><?= $loginHrefValue ?></a>
          <a class="btn btn-outline-light me-2<?= $adminDisplayNone ?>" href = <?= ADMIN_PAGE ?>>Панель управления</a>
          <a class="btn btn-warning<?= $displayNone ?>" href = "<?= REGISTER_PAGE ?>">Зарегистрироваться</a>
        </div>
      </div>
    </div>
  </header>