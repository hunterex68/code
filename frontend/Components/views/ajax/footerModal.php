<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.01.2018
 * Time: 22:44
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-6 pull-right">
        <div class="btn-group">
            <?php
                echo Html::button('Добавить',['class'=>'btn btn-success js-add2basket','disabled'=>'disabled','data-url'=>Url::toRoute('basket/add')]);
            ?>
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Закрыть</button>
        </div>
    </div>
    <div class="col-md-6 push-left" style="text-align: left">
        <input type="checkbox" name="offer" id="offer">&nbsp;С <?php echo Html::a('условиями',Url::to(''))?> cогласен!
    </div>
</div>
