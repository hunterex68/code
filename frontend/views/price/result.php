<?php
/* @var $this yii\web\View */
use app\components\searchFormWidget;
use yii\grid\GridView;

?>
<?= searchFormWidget::widget();?>
<?= GridView::widget([
	'dataProvider' => $model,
	'columns' => [
		'Make',
		'DetailNum',
		'PartNameRus',
		'PriceLogo',
		'Region',
		'Delivery',
		'WeightGr',
		'Available',
		'Price',
		's:"<span>!</span>"'

	],
]);
?>

