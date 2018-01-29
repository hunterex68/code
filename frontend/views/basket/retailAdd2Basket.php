<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2017
 * Time: 22:06
 */
use yii\helpers\Html;
$data = json_decode(base64_decode($model));
?>


<div class="container-fluid">
    <form id='addform'>
<?php


?>
    <hr>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">

            <span id="make" style="font-weight: bold"><?php echo $data->make ?></span>
            &nbsp;
            <span id="code" style="font-weight: bold"><?php echo $data->code ?></span>
            &nbsp;
            <span id="name"><?php echo $data->name ?></span>
        </div>
    </div>
    <hr>


    <?php echo Html::hiddenInput('extradata',$model); ?>

    <div class="row">
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('Кол-во');?><div class="clearfix"></div>
            <?php echo Html::input('number','quan','1',['min'=>1,'class'=>'form-control','id'=>'quan']);?>
        </div>
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
            <?php echo Html::label('Цена');?><div class="clearfix"></div>
            <span class="btn btn-success btn-sm" id="price"><?php echo $data->price;?></span>
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

        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12" style="text-align: center">
            <?php echo Html::label('Упаковка<br/>');?><div class="clearfix"></div>
            <?php echo Html::dropDownList('pack','',[''=>'','WOOD'=>'Дерево','CARTON'=>'Картон'],['class'=>'form-control']);?>

        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12" style="text-align: center">
            <?php echo Html::label('Wait');?><div class="clearfix"></div>

            <?php echo Html::checkbox('wait',false,['class'=>'form-control'])?>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12" style="text-align: center">
            <?php echo Html::label('Контейнер');?><div class="clearfix"></div>
            <?php echo Html::checkbox('container',false,['class'=>'form-control'])?>
        </div>
        <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12" style="text-align: center">
            <?php echo Html::label('Бренд');?><div class="clearfix"></div>
            <?php echo Html::checkbox('brand',false,['class'=>'form-control'])?>
        </div>
    </div>
    </form>
</div>