<?php
    if (!$_POST['id']) {
        header("Location: index.php");
    } else {
        $author = strip_tags(trim((string)$_POST['author']));
        $text = strip_tags(trim((string)$_POST['text']));
        $id = (int)$_POST['id'];
    }

    if ($author == '') {
        $author = "Неизвестный пользователь";
    }

    if ($text == '') {
        $text = "Этот автор не оставил комментария";
    }
    
    require_once("config.php");
    $sql = "insert into reviews (reviewer, text, good_id) values (\"$author\", \"$text\", $id)";
    $res = mysqli_query($connect, $sql);
    if (!$res) {
        die("Ошибка записи в базу данных!");
    } else {
        $detailViewPage = DETAIL_VIEW_PAGE;
        header("Location: $detailViewPage?id=$id");
    }
?>