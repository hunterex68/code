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

            <?php

            echo Gridview::widget([

                'dataProvider' => $basket,

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
                                return Html::a(Yii::t('app', 'Изменить'), $url, ['class' => 'btn btn-success btn-xs']);
                            },

                            'delete' => function ($url) {
                                return Html::a(Yii::t('app', 'Удалить'), $url, ['class' => 'btn btn-danger btn-xs']);
                            }
                        ]
                    ]
                ]
            ]);

            ?>

        </div>
    </div>
</div>