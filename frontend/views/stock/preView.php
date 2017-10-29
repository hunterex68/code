<?php
use yii\bootstrap\ActiveForm;
use app\assets\StockAsset;
use app\Components\Utilites;
StockAsset::register($this);
use yii\helpers\Html;
?>

<div class="container" id="body">
    <div class="row">
    	<div class="col-md-8 col-md-offset-1 col-lg-8 col-lg-offset-1">
           <? $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',
            'class' => 'form-inline'], 'method' => 'post', 'id'=>'updPrice',
            'action' => ['stock/add'], ]);?>

           <?=Html::hiddenInput('table',$table);?>
                 <? if($dataProvider) :?>
                    <h2>Предварительный просмотр</h2>
                    <?= Html::submitButton('Добавить' , ['class'=>'btn btn-primary']) ?>
                    <hr />
                    <table class='table table-hover'>

                       <?php

                            if(count($format)==0)
                            {
                                $format['f5']=0;
                                $format['f1']=0;
                                $format['f2']=0;
                                $format['f3']=0;
                                $format['f4']=0;

                            }

                       Utilites::printSel(count($dataProvider[0]),$format);

                       ?>
                       <tbody>
                       <?php foreach($dataProvider as $key=>$val) :?>
                            <tr>
                                <?php foreach($val as $v) :?>
                                    <td><?php echo $v;?></td>
                                <?php endforeach; ?>
                            </tr>
                       <?php endforeach; ?>
                       </tbody>
                   </table>
                <?php endif; ?>

            <?php ActiveForm::end() ?>
    	</div>
    </div>
</div>;