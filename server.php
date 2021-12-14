<?php
    $filename = $_FILES['photo']['name'];
    $pathBig = "img/big/".$filename;
    $pathSmall = "img/small/".$filename;
    require_once('config.php');
    if ($_GET['action'] == 'delete') {
        $id = $_GET['id'];
        $sql = "select * from images where id = $id";
        $res = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($res);
        $path = $data['pathbig'].'\\'.$data['title'];
        unlink($path);
        $path= $data['pathsmall'].'\\'.$data['title'];    
        unlink($path);
        $sql = "delete from images where id = $id";
        $res = mysqli_query($connect, $sql);
        $message = "<p class = \"alert alert-success\">Файл {$data['title']} успешно удален из галереи!</p>";
    } else {
        if ($_FILES['photo']['size'] > 5242880){
            $message = "<p class=\"alert alert-warning\">Размер файла $filename превышает максимально допустимый размер в 5 МБ!</p>";
            unlink($_FILES['photo']['tmp_name']);
        }
        elseif(move_uploaded_file($_FILES['photo']['tmp_name'],$pathBig)){
            $height = 200;
            list($width_orig, $height_orig) = getimagesize($pathBig);
            $ratio_orig = $width_orig/$height_orig;
            $width = $height * $ratio_orig;
            $filetype = explode('/', ($_FILES['photo']['type']))[1];
            $imageSmall = imagecreatetruecolor($width, $height);
            switch($filetype){
                case 'jpeg':
                    $imageBig = imagecreatefromjpeg($pathBig);
                    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagejpeg($imageSmall, $pathSmall);
                    $message = "<p class = \"alert alert-success\">$filename успешно загружен!</p>";
                    break;
                case 'png':
                    $imageBig = imagecreatefrompng($pathBig);
                    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagepng($imageSmall, $pathSmall);
                    $message = "<p class = \"alert alert-success\">$filename успешно загружен!</p>";
                    break;
                case 'gif':
                    $imageBig = imagecreatefromgif($pathBig);
                    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagegif($imageSmall, $pathSmall);
                    $message = "<p class = \"alert alert-success\">$filename успешно загружен!</p>";
                    break;
                default:
                    $message = "<p class=\"alert alert-warning\">$filetype - неизвестный либо недопустимый тип файла!</p>";
            }
            $sizeBig = filesize($pathBig);
            $sizeSmall = filesize($pathSmall);
            $sql = "insert into images values (NULL, \"$filename\", \"img\\\big\", \"img\\\small\", $sizeBig, $sizeSmall, 0)";
            $res = mysqli_query($connect, $sql);
        } else $message = "<p class=\"alert alert-warning\">Не выбран файл для загрузки либо произошла неизвестная ошибка!</p>";
    }
?>

<div class = "container">
    <?php
        echo $message;
        require_once("back.php");
    ?>
</div>