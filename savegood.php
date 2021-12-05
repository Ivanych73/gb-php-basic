<?php
    require_once('config.php');
    $goodTitle = trim(strip_tags((string)$_POST['title']));
    $goodTitle = mysqli_real_escape_string($connect, $goodTitle);
    $price = trim(strip_tags((string)$_POST['price']));
    $price = mysqli_real_escape_string($connect, $price);
    $description = trim(strip_tags((string)$_POST['description']));
    $description = mysqli_real_escape_string($connect, $description);
    $pathBig = "img/big/";
    $pathSmall = "img/small/";
    $addUpdateUrl = ADD_UPDATE_GOOD_PAGE;
    $adminUrl = "admin.php";

    if (!$_FILES['photo']['error']) {
        if ($_FILES['photo']['size'] > 5242880){
            $message = "Размер файла {$_FILES['photo']['name']} превышает максимально допустимый размер в 5 МБ!";
            unlink($_FILES['photo']['tmp_name']);
            header("Location: $addUpdateUrl?result=$message&id=$id");
        }
        if(!move_uploaded_file($_FILES['photo']['tmp_name'], $pathBig.$_FILES['photo']['name'])) {
            $message = "Ошибка загрузки файла {$_FILES['photo']['name']}!";
            unlink($_FILES['photo']['tmp_name']);
            header("Location: $addUpdateUrl?result=$message&id=$id");
        } else {
            $filename = $_FILES['photo']['name'];
            $message = "$filename успешно загружен в $pathBig! ";
            $height = 200;
            list($width_orig, $height_orig) = getimagesize($pathBig.$filename);
            $ratio_orig = $width_orig/$height_orig;
            $width = $height * $ratio_orig;
            $filetype = explode('/', ($_FILES['photo']['type']))[1];
            $imageSmall = imagecreatetruecolor($width, $height);
            switch($filetype){
                case 'jpeg':
                    $imageBig = imagecreatefromjpeg($pathBig.$filename);
                    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagejpeg($imageSmall, $pathSmall.$filename);
                    $message .= "Уменьшенный $filename успешно загружен в $pathSmall! ";
                    break;
                case 'png':
                    $imageBig = imagecreatefrompng($pathBig.$filename);
                    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagepng($imageSmall, $pathSmall.$filename);
                    $message .= "Уменьшенный $filename успешно загружен в $pathSmall! ";
                    break;
                case 'gif':
                    $imageBig = imagecreatefromgif($pathBig.$filename);
                    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagegif($imageSmall, $pathSmall.$filename);
                    $message .= "Уменьшенный $filename успешно загружен в $pathSmall! ";
                    break;
                default:
                    $message .= "$filetype - неизвестный либо недопустимый тип файла! ";
            }
        }
    }

    if ($_POST['id']){
        $id = (int)$_POST['id'];
        $sql = "update catalog set title = \"$goodTitle\", price = $price, description = \"$description\" where id = $id";
        $res = mysqli_query($connect, $sql);
        if (!$res) {
            $message .= "Не удалось сохранить данные о $goodTitle в базе данных!";
            header("Location: $adminUrl?result=$message");
        } else {
            $message .= "Измененные данные о $goodTitle успешно сохранены в базе данных! ";
            if ($filename) {
                $filename = mysqli_real_escape_string($connect, $filename);
                $sizeBig = filesize($pathBig.$filename);
                $sizeSmall = filesize($pathSmall.$filename);
                $sql = "select title from images where good_id = $id";
                $res = mysqli_query($connect, $sql);
                if (mysqli_num_rows($res)) {
                    $oldImageTitle = mysqli_fetch_assoc($res)['title'];
                    if(!unlink($pathBig.$oldImageTitle)) {
                        $message .= "Не удалось удалить $oldImageTitle из $pathBig! ";
                    } else {
                        $message .= "$oldImageTitle успешно заменен на $filename в $pathBig! ";
                    }
                    if(!unlink($pathSmall.$oldImageTitle)) {
                        $message .= "Не удалось удалить уменьшенный $oldImageTitle из $pathSmall! ";
                    } else {
                        $message .= "Уменьшенный $oldImageTitle успешно заменен на уменьшенный $filename в $pathSmall! ";
                    }
                    $sql = "update images set title = \"$filename\", sizebig = $sizeBig, sizesmall = $sizeSmall where good_id = $id";
                } else {
                    $sql = "insert into images (title, pathbig, pathsmall, sizebig, sizesmall, clicks, good_id) values (\"$filename\", \"img\\\big\", \"img\\\small\", $sizeBig, $sizeSmall, 0, $id)";
                }                
                $res = mysqli_query($connect, $sql);
                if (!$res) {
                    $message .= "Не удалось сохранить данные о $filename в базе данных!";
                    header("Location: $adminUrl?result=$message");
                } else {
                    $message .= "Данные о $filename успешно сохранены в базе данных!";
                }
            }
            header("Location: $adminUrl?result=$message");
        }
    }else {
        $sql = "insert into catalog (title, price, description) values (\"$goodTitle\", $price, \"$description\")";
        $res = mysqli_query($connect, $sql);
        if(!$res) {
            $message .= "Не удалось сохранить данные о $goodTitle в базе данных!";
            header("Location: $adminUrl?result=$message");            
        } else {
            $message .= "Данные о новом товаре $goodTitle успешно сохранены в базе данных! ";
            if ($filename) {
                $filename = mysqli_real_escape_string($connect, $filename);
                $sizeBig = filesize($pathBig.$filename);
                $sizeSmall = filesize($pathSmall.$filename);
                $sql = "select id from catalog where title = \"$goodTitle\" and price = $price and description =  \"$description\"";
                $res = mysqli_query($connect, $sql);
                if (!$res) {
                    $message .= "Не удалось получить данные о $goodTitle из базы данных!";
                    header("Location: $adminUrl?result=$message");
                } else {
                    $id = mysqli_fetch_assoc($res)['id'];
                    $sql = "insert into images (title, pathbig, pathsmall, sizebig, sizesmall, clicks, good_id) values (\"$filename\", \"img\\\big\", \"img\\\small\", $sizeBig, $sizeSmall, 0, $id)";
                    $res = mysqli_query($connect, $sql);
                    if (!$res) {
                        $message .= "Не удалось сохранить данные о $filename в базе данных!";
                        header("Location: $adminUrl?result=$message");
                    } else {
                        $message .= "Данные о $filename успешно сохранены в базе данных!";
                    }
                }
            }
            header("Location: $adminUrl?result=$message");
        }
    }
?>