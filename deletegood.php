<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    if(!$_COOKIE['isAdmin']) {
        $error = "Для входа в панель управления надо сначала авторизоваться как администратор.";
        header("Location: ".AUTH_PAGE."?error=$error");
    } else {
        if (!$_GET['id']) {
            header("Location: admin.php");
        } else {
            $id = (int)$_GET['id'];
        }
        require_once("config.php");
        $sql = "select title, pathbig, pathsmall from images where good_id = $id";
        $res = mysqli_query($connect, $sql);
        if (!$res) {
            die("Ошибка запроса к базе данных!");
        }
        $imageData = mysqli_fetch_assoc($res);
        if(!unlink($imageData['pathbig'].'\\'.$imageData['title'])){
            $message .= "Не удается удалить {$imageData['title']} из {$imageData['pathbig']}! ";
        }
        if(!unlink($imageData['pathsmall'].'\\'.$imageData['title'])){
            $message .= "Не удается удалить уменьшенный {$imageData['title']} из {$imageData['pathsmall']}! ";
        }
        $sql = "delete from catalog where id = $id";
        $res = mysqli_query($connect, $sql);
        if (!$res) {
            die("Ошибка удаления записи из базы!");
        } else {
            $message .= "Товар успешно удален!";
        }
        header("Location: admin.php?result=$message");
    }
?>