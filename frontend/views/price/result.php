<?php
/* @var $this yii\
 * eb\View */
use app\components\searchFormWidget;
use app\components\Writer;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<style>

	.toptitle {
		position: fixed;
		top: 157px;
		left: 0;
		padding: 10px;
		z-index: 999;
	}

	.content {
		margin-top: 80px;
	}
</style>
<?php Pjax::begin()?>
<?= searchFormWidget::widget(); ?>
<? $render = new Writer(); ?>
<div class="container content">
	<?php if (!empty($brands)) : ?>

		<div class='row'>
			<div class='col-md-12' style='background-color: white'>
				<div class="panel well">
					<h1>Выберите производителя</h1>
					<h3>Уточните, пожалуйста.<br> Номер детали присутствует в каталогах нескольких производителей</h3>
					<hr>
					<table class='table table-stripd' style="width:50%">
						<?php foreach($brands as $str):?>
							<tr>
								<td>
									<?

										echo Html::a($str, 'find?oem='.$code.'&brand='.$str);

									?>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if (!empty($model)) : ?>
	<div class='row'>
			<div class='col-md-12' style='background-color: white'>
				<?/*= GridView::widget([
					'dataProvider' => $model,
					'caption'=>"<h1>Прайс по ОАЭ</h1>",
					'headerRowOptions'=>["class"=>"bg-info"],
					'columns' => [
						['attribute' => 'MakeName',
							'format' => 'text',
							'label' => 'Производитель',],
						['attribute' => 'DetailNum',
							'format' => 'text',
							'label' => 'Код',],
						['attribute' => 'PartNameRus',
							'format' => 'text',
							'label' => 'Описание',],
						['attribute' => 'PriceLogo',
							'format' => 'text',
							'label' => 'Регион',],
						['attribute' => 'Delivery',
							'format' => 'text',
							'label' => 'Срок доставки',],
						['attribute' => 'WeightGr',
							'format' => 'text',
							'label' => 'Вес',],
						['attribute' => 'Available',
							'format' => 'text',
							'label' => 'К-во',],
						['attribute' => 'Price',
							'format' => 'text',
							'label' => 'Цена',],
						[
							'class' => 'yii\grid\ActionColumn',
							'template' => '{link}',
							'urlCreator'=>function($action, $model, $key, $index)
							{
								$hash  = base64_encode("code:".$model->DetailNum."#");
                                return \yii\helpers\Url::to(['basket/add?data='.$hash]);
                            },
							'buttons' => [

								'link' => function ($url, $model, $key) {
									return Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', $url);
								},
							],
						],
					],
					'showFooter' => false,
					'layout' => '{pager}{summary}{items}',
					'filterPosition' => FILTER_POS_FOOTER,
					'rowOptions' => function ($model, $key, $index, $grid) {
						$class = $index % 2 ? 'odd' : 'even';
						return [
							'key' => $key,
							'index' => $index,
							'class' => $class
						];
					},
				]);*/?>
				<?php
					/*print_r($model);
				die();*/
					$input = "<input type='number' min='1' pattern='[0-9]{,9}' class='form-control' style='width:80px' name='q' id='q' value='1'>";
					$button = Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', "basketAdd");
					$render->caption = "<h1>Прайс по ОАЭ</h1>";
					$render->columns = ['MakeName'=>'Бренд',"DetailNum"=>"Код детали","PartNameRus"=>"Наименование","PriceLogo"=>"Регион","WeightGr"=>"Вес, гр.","GuaranteedDay"=>"Доставка гар., дн.", "Price"=>"Цена","Available"=>"Доступно","!$input"=>"","!$button"=>""];
					$render->renderTable($model);
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if (!empty($stock)) : ?>
		<div class='row'>
			<div class='col-md-12' style='background-color: white'>
				<h1>Прайс по Украине</h1>
					<? $render->columns=['brand'=>'Бренд',"code"=>"Код детали","description"=>"Наименование"];?>
					<?php $render->renderTable($stock);?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php Pjax::end();?>