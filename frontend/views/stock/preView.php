<?php
use yii\bootstrap\ActiveForm;
use app\assets\StockAsset;
use app\Components\Utilites;
StockAsset::register($this);
use yii\helpers\Html;
?>
<div class="stub"></div>
<div class="container-fluid" id="body">
    <div class="row">
    	<div class="col-md-8 col-md-offset-1 col-lg-8 col-lg-offset-1">
           <? $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',
            'class' => 'form-inline'], 'method' => 'post', 'id'=>'updPrice',
            'action' => ['stock/add'], ]);?>

           <?=Html::hiddenInput('table',$table);?>
            <?=Html::hiddenInput('delete_content',$delete_content);?>
                 <? if($dataProvider) :?>
                    <h2>Предварительный просмотр</h2>
                    <?= Html::submitButton('Добавить' , ['class'=>'btn btn-primary']) ?>
                    <hr />

                    <?php echo yii\grid\GridView::widget([

                         'dataProvider' => $dataProvider,
                         'columns' => [
                             [
                                 'attribute'=>'f1',
                                 'format' => 'raw'
                             ],
                             [
                                 'attribute'=>'f2',
                                 'format' => 'raw'
                             ],
                             [
                                 'attribute'=>'f3',
                                 'format' => 'raw'
                             ],
                             [
                                 'attribute'=>'f4',
                                 'format' => 'raw'
                             ],
                             [
                                 'attribute'=>'f5',
                                 'format' => 'raw'
                             ],
                             [
                                 'attribute'=>'f6',
                                 'format' => 'raw'
                             ],
                         ]

                    ]);
                       ?>
                <?php endif; ?>

            <?php ActiveForm::end() ?>
    	</div>
    </div>
</div>;