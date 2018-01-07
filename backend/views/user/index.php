<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="widget widget-table action-table">

            <div class="widget-header"> <i class="icon-th-list"></i>
                <h3>Список клиентов и пользователей</h3>
            </div>

            <div class="widget-content">

                <?= GridView::widget([

                    'dataProvider' =>$provider,
                    'showOnEmpty' => false,
                    'emptyText' => '<table><tbody></tbody></table>',
                    'columns' => [

                        // Обычные поля определенные данными содержащимися в $dataProvider.
                        // Будут использованы данные из полей модели.
                        'id',
                        'rid',


                        [
                            'label' => Yii::t('app', 'Имя'),
                            'format' => 'raw',
                            'options' => ['style' => 'max-width:50px;'],
                            'attribute'=>'username',
                        ],

                        'password',
                        'email',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'options' => ['style' => 'max-width:70px;'],
                            'template' => '{edit} {delete}',
                            'buttons' => [
                                'edit' => function ($url,$model) {
                                    return Html::a(Yii::t('app', 'Изменить'), Url::toRoute("user/edit?id=".$model['id']), ['class' => 'btn btn-success btn-xs']);
                                },
                                'delete' => function ($url) {
                                    return Html::a(Yii::t('app', 'Удалить'), $url, ['class' => 'btn btn-danger btn-xs']);
                                },
                            ],
                        ],
                    ],
                ]);?>
            </div>
        </div>
    </div>
</div>