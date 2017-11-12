<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 25.10.2016
 * Time: 22:40
 */
use yii\widgets\ActiveForm;
use app\assets\StockAsset;
use yii\helpers\Html;
//use yii\widgets\Pjax;
use frontend\models\UploadForm;
StockAsset::register($this);
?>
<div class="stub">

</div>
<div class="container">
	<div class="row">
    		<div class="col-md-12">
				<h1>Загрузка прайсов</h1>
				<hr/>
			</div>
	</div>
	<div class="row">
		<div class="col-md-8  col-lg-8">
			<div class="panel">
				<div class="panel-body">
					<?
						$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',
						'class' => 'form-inline'], 'method' => 'post', 'id'=>'uplPrice','action' => ['stock/upl'], ])
					?>
					<span class="btn btn-success fileinput-button">
						<i class="glyphicon glyphicon-folder-open">  Файл</i>
						<input type="file" id="uploadform-file" name="UploadForm[file]" onChange="$('.list').append('<p>'+$(this).val()+'</p>');"/>
					</span>
					<?= Html::submitButton('Добавить' , ['class'=>'btn btn-primary']) ?>

					<hr>
					<?= Html::checkbox('save_format',false,['class'=>'ch form-control','label'=>'Использовать сохраненный порядок колонок']) ?><br/>
					<?= Html::checkbox('delete_content',true,['class'=>'ch form-control','label'=>'С удалением старых данных']) ?><br/>


					<?php ActiveForm::end() ?>
					<div class="list"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">

					Порядок колонок

				</div>

				<div class="panel-body">

					<? if(isset($format)) :?>
					<? $frm = ActiveForm::begin(['options' => ['class' => 'form-inline'], 'method' => 'post', 'id'=>'uplPrice','action' => ['index'], ]);?>
					<table class="table table-hover">
							<?= Html::HiddenInput('Fileformat[UserId]', \Yii::$app->user->identity->getId())?>
							<?= Html::activeHiddenInput($format, 'id')?>
							<?php $i=1; foreach($format as $key=>$val): ?>
								<?php if($i>2):?>
										<tr>
											<td style="text-align:right">
												<?= $frm->field($format,$key)->input('number',['min'=>'1'])->label();?>
											</td>
										</tr>
									<?php endif;?>
									<?php $i++;?>
							<?php endforeach; ?>
							<tr>
								<td>
									<?= Html::submitButton('Сохранить', ['class'=>'btn btn-success']);?>
								</td>
							</tr>
						</table>
					<?php ActiveForm::end();?>
					<?php endif;?>
					</div>
				</div>
			</div>
		</div>
</div>