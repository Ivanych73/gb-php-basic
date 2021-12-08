<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson7</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>
<body>
    <?php 
        require_once('header.php');
        require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
    ?>
    <div class = "container"> 
        <?php
            if(!$_COOKIE['isAdmin']) {
                $error = "Для входа в панель управления надо сначала авторизоваться как администратор.";
                header("Location: ".AUTH_PAGE."?error=$error");
            } else {
                require_once('config.php');
                $sql = "select catalog.id as goodId, catalog.title as goodTitle, price, images.id as imageId, images.title as imageTitle, images.pathsmall, images.clicks FROM catalog LEFT JOIN images on images.good_id = catalog.id order by catalog.id desc";
                $res = mysqli_query($connect, $sql);
                if(!$res) {
                    die("Ошибка получения информации о товаре из базы данных!");
                }
                while ($data = mysqli_fetch_assoc($res)) {
                    $goods[] = $data;
                }
            }
        ?>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Панель управления магазина котиков</h1>
                    <p><a href="<?= ADD_UPDATE_GOOD_PAGE?>" class="btn btn-primary my-2">Добавить новый товар</a></p>
                </div>
            </div>
        </section>
        <?php 
            if ($_GET['result']) :
            $result = trim(strip_tags((string)$_GET['result']));
        ?>
        <p class="alert alert-warning"><?= $result?></p>

        <?php endif;?>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3\">
                    <?php
                        foreach ($goods as $value) {
                            if($value['imageTitle'] == "") {
                                $value['imageTitle'] = "nophoto.png";
                                $value['pathsmall'] = "img\\small";
                            }
                            $card = file_get_contents('templates\card.tpl');
                            $pattern = [
                                '/{detailViewHref}/', 
                                '/{detailText}/',
                                '/{thumbnailPath}/',
                                '/{imgTitle}/',
                                '/{buyOrDelHref}/',
                                '/{buyOrDelText}/',
                                '/{goodTitle}/',
                                '/{price}/'
                            ];
                            $replacement = [
                                ADD_UPDATE_GOOD_PAGE."?id={$value['goodId']}", 
                                "Редактировать",
                                $value['pathsmall'],
                                $value['imageTitle'],
                                "deletegood.php?id={$value['goodId']}",
                                "Удалить",
                                $value['goodTitle'],
                                $value['price']                
                            ];
                            echo preg_replace($pattern, $replacement, $card);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>