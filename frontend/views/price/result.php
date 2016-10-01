<?php
/* @var $this yii\web\View */
use app\components\searchFormWidget;
use yii\bootstrap\Html;
use yii\grid\GridView;

?>
<?= searchFormWidget::widget();?>
<div class="container">
	<div class="row">
		<div class="col-md-12" style="background-color: white">
<?= GridView::widget([
	'dataProvider' => $model,
	'columns' => [
		'Make',
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

		//['class' => 'yii\grid\ActionColumn'],
		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{link}',
			'buttons' => [

				'link' => function ($url,$model,$key) {
					return Html::a('<span class="glyphicon glyphicon-basket"></span>', $url);
				},
			],],
	],
	'showFooter' => true,
	'layout' => '{pager}{summary}{items}',
	'filterPosition' => FILTER_POS_FOOTER,
	'rowOptions'=>function ($model, $key, $index, $grid){
		$class=$index%2?'odd':'even';
		return [
			'key'=>$key,
			'index'=>$index,
			'class'=>$class
		];
	},

]);

?>
		</div>
	</div>
</div>
