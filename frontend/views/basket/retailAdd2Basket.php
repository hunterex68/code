<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2017
 * Time: 22:06
 */
use yii\helpers\Html;
use kartik\checkbox\CheckboxX;
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <label for="make">Производитель</label><div class="clearfix"></div>
            <span id="make"><?php echo $model->make ?></span>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <label for="code">Код</label><div class="clearfix"></div>
            <span id="code"><?php echo $model->code ?></span>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <label for="name">Наименование</label><div class="clearfix"></div>
            <span id="name"><?php echo $model->name ?></span>
        </div>
    </div>
    <hr>
    <?php Html::beginForm('add-item');?>
    <div class="row">
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('Кол-во');?><div class="clearfix"></div>
            <?php echo Html::input('number','quan','1',['min'=>1,'class'=>'form-control','id'=>'quan']);?>
        </div>
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('Цена');?><div class="clearfix"></div>
            <span class="btn btn-success btn-lg" id="price"><?php echo $model->price;?></span>
        </div>
        <div class="col-md-2 col-lg-23 col-xs-12 col-sm-12">
            <?php echo Html::label('Сумма');?><div class="clearfix"></div>
            <span class="btn btn-warning btn-lg" id="sum"></span>
        </div>
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('ДПЦ');?><div class="clearfix"></div>
            <?php echo Html::input('number','dpc','10',['min'=>0,'class'=>'form-control','id'=>'dpc']);?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <?php echo Html::label('Доставка');?><div class="clearfix"></div>
            <span class="btn btn-warning">Контейнер</span>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <?php echo Html::label('Упаковка<br/>');?><div class="clearfix"></div>
            <?php echo Html::dropDownList('pack','',[''=>'','WOOD'=>'Дерево','CARTON'=>'Картон'],['class'=>'form-control']);?>

        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <?php echo Html::label('Готов ждать месяц');?><div class="clearfix"></div>

            <?php echo Html::checkbox('wait',false,['class'=>'form-control'])?>
        </div>
    </div>
    <?php echo Html::endForm();?>
</div>