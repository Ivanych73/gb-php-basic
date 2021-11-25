<?php
$path = "img/".$_FILES['photo']['name'];
if ($_FILES['photo']['size'] > 5242880){
    $message = "Размер файла {$_FILES['photo']['name']} превышает максимально допустимый размер в 5 МБ!<br>";
    unlink($_FILES['photo']['tmp_name']);
}
elseif(move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
    $message = $_FILES['photo']['name']." успешно загружен!<br>";
}

echo $message;

require_once("back.php");
?>