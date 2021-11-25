<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson4 task1</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Фотогалерея</h1>
    <?php
        $path = "\img\\";
        $images = ["1.jpg", "2.jpg", "3.jpg", "4.jpg", "5.jpg", "6.jpg", "7.jpg", "8.jpg", "9.jpg",];
        if (isset($_GET["new_img"]))
            $images[] = $_GET["new_img"];
        $imgTag = "<img class = gallery-img src = $path";
        foreach ($images as $key => $value) {
            $hrefTag = "<a href = \"fullImage.php?img=$path$value\">";
            $gallery .= $hrefTag.$imgTag.$value." alt = \"\"></a>";
            if (($key+1) % 3 === 0)
                $gallery .= "<br>";
        }
        echo $gallery;
    ?>
    <form action="server1.php" method="post" enctype="multipart/form-data">
        <p>Загрузить файл в галерею</p>
        <input type="file" accept = "image/*" name="photo"><br><br>
        <input type="submit" value="Загрузить">
    </form>
</body>
</html>