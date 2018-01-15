<?php

use yii\widgets\DetailView;

?>
<div class="row">
    <div class="col-md-8 col-md-offset-2" style="background-color:white">
        <div class="home">

            <?php

            echo DetailView::widget([

                'model' => $data,
                    'attributes' =>[
                    'pin',
                [
                    'label' => Yii::t('app', 'Город'),
                    'captionOptions' => ['style'=>'width:100px'],
                    'attribute'=>'city',
                ],
                [
                    'label' => Yii::t('app', 'Адрес'),

                    'attribute'=>'address',
                ],
                [
                    'label' => Yii::t('app', 'Группа'),

                    'attribute'=>'groupid',
                ],
                [
                    'label' => Yii::t('app', 'Получатель'),

                    'attribute'=>'recipient',
                ],
                        ]
            ]);

            ?>

        </div>
    </div>
</div>