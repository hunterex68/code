<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2017
 * Time: 22:06
 */
use yii\helpers\Html;

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">

            <span id="make" style="font-weight: bold"><?php echo $model->make ?></span>
            &nbsp;
            <span id="code" style="font-weight: bold"><?php echo $model->code ?></span>
            &nbsp;
            <span id="name"><?php echo $model->name ?></span>
        </div>
    </div>
    <hr>
    <form id='addform'>

    <?php echo Html::hiddenInput('extradata',base64_encode(json_encode($model))); ?>

    <div class="row">
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('Кол-во');?><div class="clearfix"></div>
            <?php echo Html::input('number','quan','1',['min'=>1,'class'=>'form-control','id'=>'quan']);?>
        </div>
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('Цена');?><div class="clearfix"></div>
            <span class="btn btn-success btn-sm" id="price"><?php echo $model->price;?></span>
        </div>
        <div class="col-md-2 col-lg-23 col-xs-12 col-sm-12">
            <?php echo Html::label('Сумма');?><div class="clearfix"></div>
            <span class="btn btn-warning btn-sm" id="sum"></span>
        </div>
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('ДПЦ');?><div class="clearfix"></div>
            <?php echo Html::input('number','dpc','10',['min'=>0,'class'=>'form-control','id'=>'dpc']);?>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <?php echo Html::label('Упаковка<br/>');?><div class="clearfix"></div>
            <?php echo Html::dropDownList('pack','',[''=>'','WOOD'=>'Дерево','CARTON'=>'Картон'],['class'=>'form-control']);?>

        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
            <?php echo Html::label('Готов ждать месяц');?><div class="clearfix"></div>

            <?php echo Html::checkbox('wait',false,['class'=>'form-control'])?>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
            <?php echo Html::label('Доставка');?><div class="clearfix"></div>
            <?php echo Html::checkbox('wait',false,['class'=>'form-control'])?>
        </div>
    </div>
    </form>
</div>