<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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

          <div class="text-end d-flex">
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
                $userDisplayNone = " d-none";
                unset($displayNone);
              }
              if($_COOKIE['isAdmin']) {
                $adminDisplayNone = "";
              } else {
                $adminDisplayNone = " d-none";
              }
            ?>
            <div class="dropdown">
              <button class="btn btn-outline-light me-2 dropdown-toggle <?= $userDisplayNone ?>" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Личный кабинет
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="personal.php">Информация</a>
                <a class="dropdown-item" href="personalorders.php">Заказы</a>
              </div>
            </div>
            <p class="text-muted px-2"><?=$loginMessage ?></p>
            <a class="btn btn-outline-light me-2" href = <?= $loginHref ?>><?= $loginHrefValue ?></a>
            <div class="dropdown">
              <button class="btn btn-outline-light me-2 dropdown-toggle <?= $adminDisplayNone ?>" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Панель управления
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= ADMIN_PAGE ?>">Управление товарами</a>
                <a class="dropdown-item" href="<?=MANAGE_ORDERS_PAGE?>">Управление заказами</a>
              </div>
            </div>
            <a class="btn btn-warning<?= $displayNone ?>" href = "<?= REGISTER_PAGE ?>">Зарегистрироваться</a>
          </div>
        </div>
      </div>
    </header>