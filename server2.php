<?php
$filename = $_FILES['photo']['name'];
$pathBig = "img/big/".$filename;
$pathSmall = "img/small/".$filename;
if ($_FILES['photo']['size'] > 5242880){
    $message = "Размер файла $filename превышает максимально допустимый размер в 5 МБ!<br>";
    unlink($_FILES['photo']['tmp_name']);
}
elseif(move_uploaded_file($_FILES['photo']['tmp_name'],$pathBig)){
    $message = "$filename успешно загружен!<br>";
    $height = 200;
    list($width_orig, $height_orig) = getimagesize($pathBig);
    $ratio_orig = $width_orig/$height_orig;
    $width = $height * $ratio_orig;
    $imageSmall = imagecreatetruecolor($width, $height);
    $imageBig = imagecreatefromjpeg($pathBig);
    imagecopyresampled($imageSmall, $imageBig, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    imagejpeg($imageSmall, $pathSmall);
}

echo $message;

require_once("back.php");
?>