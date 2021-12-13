<?php require_once('header.php');?>
    <div class = "container"> 
        <?php
            require_once('config.php');
            require_once("{$_SERVER['DOCUMENT_ROOT']}/urls.php");
            $sql = "select catalog.id as goodId, catalog.title as goodTitle, price, images.id as imageId, images.title as imageTitle, images.pathsmall, images.clicks FROM catalog LEFT JOIN images on images.good_id = catalog.id order by clicks desc";
            $res = mysqli_query($connect, $sql);
            if(!$res) {
                die("Ошибка получения информации о товаре из базы данных!");
            }
            while ($data = mysqli_fetch_assoc($res)) {
                $goods[] = $data;
            }
        ?>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Добро пожаловать в наш магазин котиков</h1>
                    <p class="lead text-muted">Здесь Вы можете полюбоваться на прекрасных котиков и даже выбрать себе какого-нибудь!</p>
                </div>
            </div>
        </section>
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
                                DETAIL_VIEW_PAGE."?id={$value['goodId']}", 
                                "Подробнее об этом котике",
                                $value['pathsmall'],
                                $value['imageTitle'],
                                ADD_TO_CART."?id={$value['goodId']}",
                                "Купить",
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
<?php require_once('footer.php');?>