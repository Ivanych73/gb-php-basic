<?php
    if($orders) :
        foreach ($orders as $value) :
?>
        <div class="row  py-2">
            <div class="col-2"><?= $value['id'] ?></div>
            <div class="col-2"><?= $value['totalPrice'] ?></div>
            <div class="col-2"><?= $value['date'] ?></div>
            <div class="col-2"><?= $value['orderStatus'] ?></div>
            <div class="col-2">
                <a 
                    href="orderdetail.php?id=<?= $value['id'] ?>"
                    class="btn btn-secondary">
                    Подробнее о заказе № <?= $value['id'] ?>
                </a>        
            </div>
            <div class="col-2">
                <?php
                    if(!in_array($value['statusId'], ORDER_CLOSED)) :
                ?>
                <a 
                    href="updateorder.php?id=<?= $value['id'] ?>&status=<?= $status ?>"
                    class="btn btn-secondary">
                    Отменить заказ № <?= $value['id'] ?>
                </a>
                <?php
                    else:
                        echo "Заказ закрыт и не может быть отменен!";
                    endif;
                ?>
            </div>
        </div>
<?php
        endforeach;
    endif;
?>