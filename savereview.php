<?php
    if (!$_POST['id']) {
        header("Location: index.php");
    } else {
        $author = strip_tags(trim((string)$_POST['author']));
        $text = strip_tags(trim((string)$_POST['text']));
        $id = (int)$_POST['id'];
        require_once("config.php");
        require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
        mysqli_set_charset($connect, "utf8mb4");
        $author = mysqli_real_escape_string($connect, $author);
        $text = mysqli_real_escape_string($connect, $text);
    }

    if ($author == '') {
        $author = "Неизвестный пользователь";
    }

    if ($text == '') {
        $text = "Этот автор не оставил комментария";
    }
    
    $sql = "insert into reviews (reviewer, text, good_id) values (\"$author\", \"$text\", $id)";
    $res = mysqli_query($connect, $sql);
    if (!$res) {
        die("Ошибка записи в базу данных!");
    } else {
        header("Location: ".DETAIL_VIEW_PAGE."?id=$id");
    }
?>