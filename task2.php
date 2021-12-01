<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson4 task2</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Фотогалерея</h1>
    <?php
        $pathSmall = "\img\small\\";
        $pathBig = "\img\big\\";
        $images = scandir("img\small");
        array_shift($images);
        array_shift($images);
        $imgTag = "<img class = gallery-img src = $pathSmall";
        foreach ($images as $key => $value) {
            $hrefTag = "<a href = \"fullImage.php?img=$pathBig$value\">";
            $gallery .= $hrefTag.$imgTag.$value." alt = \"\"></a>";
            if (($key+1) % 3 === 0)
                $gallery .= "<br>";
        }
        echo $gallery;
    ?>
    <form action="server2.php" method="post" enctype="multipart/form-data">
        <p>Загрузить файл в галерею</p>
        <input type="file" accept = "image/*" name="photo"><br><br>
        <input type="submit" value="Загрузить">
    </form>
</body>
</html>