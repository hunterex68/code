<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.01.2018
 * Time: 22:46
 */

use yii\grid\GridView;
use yii\helpers\Html;
use common\components\ExtActionColumn;

if(Yii::$app->user->id == 0)
{
    ?>

    <div class="row">
        <div class="col-md-6">

            <input type="text" name="name" id="name" class="form-control" placeholder="<?php echo Yii::t('app','Имя')?>">
        </div>
        <div class="col-md-6">

            <input type="text" name="tel" id="tel" class="form-control" placeholder="<?php echo Yii::t('app','Телефон')?>">
        </div>
    </div>

    <?php
}

?>



<div class="row">
    <div class="col-md-12" style="background-color:white">

        <div class="btn-group">

            <?php
                echo Html::button('Заказать',['class' => 'btn btn-success']);
                echo Html::button('Пересчитать',['class' => 'btn btn-primary']);
            ?>

        </div>
        <br><br>
        <div class="alert alert-success">

            Заказ на сумму 0 грн.

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="background-color:white">
        <div class="home">
            <?php \yii\widgets\Pjax::begin(['id'=>'p-basket']); ?>
            <?php

            echo Gridview::widget([

                'dataProvider' => $basket,
                'tableOptions' => [
                    'class' => 'table table-striped table-hover'
                ],

                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'make',
                        'label' => 'Производитель',

                    ],
                    [
                        'attribute' => 'code',
                        'label' => 'Код',
                    ],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => function ($model, $key, $index, $column) {
                            return ['value' => $model['id']];
                        }
                    ],
                    [
                        'attribute' => 'Name',
                        'label' => 'Наменование',
                    ],
                    [
                        'attribute' => 'region',
                        'label' => 'Регион',
                    ],
                    [
                        'attribute' => 'quan',
                        'label' => 'К-во',
                    ],
                    [
                        'attribute' => 'price',
                        'label' => 'Цена',
                    ],
                    [
                        'attribute' => 'currency',
                        'label' => 'Валюта',
                    ],
                    [
                        'class' => 'common\components\ExtActionColumn',
                        'options' => ['style' => 'max-width:70px;'],
                        'template' => '{edit} {delete}',
                        'buttons' => [
                            'edit' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['class' => 'btn btn-success js-basket-edit']);
                            },

                            'delete' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['class' => 'btn btn-danger js-basket-delete']);
                            }
                        ]
                    ]
                ]
            ]);

            ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</div>