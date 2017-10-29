<?php
/* @var $this yii\
 * eb\View */

use yii\bootstrap\Html;
?>

    <div class='row'>
        <div class='col-md-8 col-md-offset-2' style='background-color: white'>
            <h3>Выберите производителя</h3>
            <h6 style="margin-bottom:50px;">Уточните, пожалуйста.<br> Номер детали присутствует в каталогах нескольких производителей</h6>
            <div class="block">
                <?php foreach($dataProvider as $d):?>
                    <?php $data = explode(':',$d); ?>
                    <p><?php echo Html::a($data[0],'../price/find?oem='.$data[1].'&brand='.$data[0]);?></p>
                <?php endforeach;?>
            </div>
        </div>
    </div>

