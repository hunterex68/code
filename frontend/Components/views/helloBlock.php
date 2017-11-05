<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\typeahead\Typeahead;

use yii\web\JsExpression;

?>
<div style="height:150px"></div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3 text-center">
			<? if(!empty($model['header1'])):?>
				<h1 class="hidden-xs">Все, что Вам нужно находится здесь!</h1>
			<? endif ?>
			<? if(!empty($model['header2'])):?>
				<h2 class="hidden-xs">любые запчасти на автомобиль.</h2>
			<? endif ?>
		</div>
	</div>
	<div class="row" data-spy="affix"  data-offset="10" style="background-color:#FFF;z-index:99999;width:100%;margin-top:-123px;padding:20px 0;">
		<div class="col-md-6 col-md-offset-3 text-center" >
			<form action="<?php echo Url::toRoute("price/find");?>" method = 'get' class="form-inline searchForm" role="form">

				<div class="input-group">
				<?php echo Html::hiddenInput('brand','',['id'=>'brand']);?>
				<?php

				$template = '<div class="repo"><kbd>{{brand}}</kbd>   {{code}}</div>';
				echo Typeahead::widget([
						'id' => 'oem',
						'name' => 'oem',
						'options' => ['placeholder' => 'OEM/VIN код', 'class' => 'oem'],
						'dataset' => [
							[
								'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
								'display' => 'value',
								'templates' => [
									//'notFound' => '<div class="text-danger" style="padding:0 8px">.</div>',
									'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
								],
								'remote' => [
									'url' => Url::to(['price/get-code-from-base']) . '?code=%oem%',
									'wildcard' => '%oem%'
								]
							]
						],
						'pluginEvents' => [
							'minlength' => '3',
							'typeahead:selected' => 'function(obj, item) {

								window.location = "'.Url::toRoute('price/find').'?oem="+item.code+"&brand="+item.brand

								}'
						]
					]);
					?><div class="input-group-btn">
						<button class="btn btn-success" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
