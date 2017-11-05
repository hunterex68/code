<?php

use app\components\searchFormWidget;
use app\components\MegaWidget;
use app\components\StockWidget;
use app\assets\PriceAsset;

PriceAsset::register($this);
?>

	<div class='row'>
		<div class='col-md-10 col-md-offset-1' style='background-color: white' >
			<strong id="info">Вы искали <?php echo $brands .'&nbsp;'. $code?></strong>
			<?php echo MegaWidget::widget([
				'number'=>$code,
				'brand'=> $brands,
			]);?>
		</div>
	</div>


		<div class='row'>
			<div class='col-md-10 col-md-offset-1' style='background-color: white'>
				<?php echo StockWidget::widget([
					'number'=>$code,
					'brand'=> $brands,
				]);?>
			</div>
		</div>

