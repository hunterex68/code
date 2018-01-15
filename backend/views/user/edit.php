<?php

use yii\bootstrap\Tabs;
?>
<div class="row">
    <div class="col-md-12">

        <?php

         echo Tabs::widget([
            'items' => [
                [
                    'label'     =>  'Инфо',
                    'content'   =>  $this->render('tabs/info', ['data' => $data]),
                    'active'    =>  true
                ],
                [
                    'label'     => 'Заказы',
                    'content'   =>  $this->render('tabs/orders', ['orders' => $orders])
                ],
                [
                    'label'     => 'Корзина',
                    'content'   =>  $this->render('tabs/basket', ['basket' => $basket])
                ],
            ]
        ]);

        ?>


        <!--ul class="nav nav-tabs">
            <li class="active"><a href="#home">Home</a></li>
            <li><a href="#">Профайл</a></li>
            <li><a href="#">Заказы</a></li>
            <li><a href="#">Баланс</a></li>
        </ul-->
    </div>
</div>

