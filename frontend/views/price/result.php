<?php
/* @var $this yii\web\View */
use app\components\searchFormWidget;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
function renderHeader()
{
	echo "<tr>";
		echo "<th>";

		echo "</th>";
	echo "</tr>";
}

function renderTable($provider)
{
	renderheader();
}
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

<div class="container content">
	<?php if (!empty($brands)) : ?>

		<div class='row'>
			<div class='col-md-12' style='background-color: white'>
				<h1>Выберите производителя</h1>
				<h3>Уточните, пожалуйста.<br> Номер детали присутствует в каталогах нескольких производителей</h3>
				<hr>
				<table class='table'>
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
	<?php endif; ?>
	<?php if (!empty($model)) : ?>
<h1>Прайс по ОАЭ</h1>
				<?= GridView::widget([
					'dataProvider' => $model,
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
				]);
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if (!empty($stock)) : ?>
<h1>Прайс по Украине</h1>
				<?php echo renderTable($stock);?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php Pjax::end();?>