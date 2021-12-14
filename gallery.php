<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson5</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>
<body>
    <h1>Фотогалерея</h1>
    <div class = "container">
        <?php
            require_once('config.php');
            $sql = "select * from images order by clicks desc";
            $res = mysqli_query($connect, $sql);
            while ($data = mysqli_fetch_assoc($res)) {
                $images[] = $data;
            }
            $albumBootstrapPrefixTag = "<div class=\"album py-5 bg-light\">
                <div class=\"container\">
                    <div class=\"row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3\">";
            $cellBootstrapPrefixTag = "<div class=\"col\"><div class=\"card shadow-sm\">";
            $cellBootstrapPostfixTag = "
                <div class=\"card-body\">
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <div class=\"btn-group\">";
            $cellBootstarpClosingTag = "</div></div></div></div></div>";
            $albumBootstrapPostfixTag = "</div></div></div>";
            $gallery .= $albumBootstrapPrefixTag;
            foreach ($images as $key => $value) {
                $imgTag = "<img class = gallery-img src = {$value['pathsmall']}";
                $hrefTag = "<a href = \"fullImage.php?id={$value['id']}\">";
                $buttonTag = "<a class=\"btn btn-sm btn-outline-secondary\" href=\"server.php?action=delete&id={$value['id']}\">Удалить</a>";
                $gallery .= $cellBootstrapPrefixTag.$hrefTag.$imgTag.'\\'.$value['title']." alt = \"\"></a>";
                $gallery .= $cellBootstrapPostfixTag.$buttonTag.$cellBootstarpClosingTag;
            }
            $gallery .= $albumBootstrapPostfixTag;
            echo $gallery;
        ?>
        <form action="server.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <div id="fileHelp" class="form-text">Загрузить файл в галерею.</div>
                <input type="file" accept = "image/gif, image/png, image/jpeg" name="photo" class="form-control" id="exampleInputFile1" aria-describedby="fileHelp"><br><br>
                <input type="submit" class="btn btn-primary" value="Загрузить">
            </div>
        </form>
    </div>
</body>
</html>