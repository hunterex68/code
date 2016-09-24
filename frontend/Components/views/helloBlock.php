<div class="title toptitle">
	<div class="container">
		<div class="row">
			<? if(!empty($model['header1'])):?>
				<h1 class="hidden-xs">Все, что Вам нужно находится здесь!</h1>
			<? endif ?>
			<? if(!empty($model['header2'])):?>
				<h2 class="hidden-xs">любые запчасти на автомобиль.</h2>
			<? endif ?>
			<div class="col-md-6 panel-body bg-success" style="padding:50px 0;">
				<form action="find" class="form-inline" role="form">
					<input type="text" name="vin" value="" pattern="[A-Za-z0-9]{17}" class="form-control" id="vin"
					       placeholder="VIN-код">

					<button class="btn btn-success" onClick="document.forms[0].submit();">
						продолжить&nbsp;
	                            <span>
	                                &#187;
	                            </span>
					</button>
				</form>
			</div>
			<div class="col-md-6 panel-body bg-info" style="padding:50px 0;">

				<form action="find" class="form-inline" role="form">
					<input type="text" name="oem" value="" pattern="[A-Za-z0-9]" class="form-control" id="vin"
					       placeholder="Код детали">

					<button class="btn btn-primary" onClick="document.forms[0].submit();">
						Найти!
	                            <span>
	                                &#187;
	                            </span>
					</button>
				</form>

			</div>
		</div>
	</div>
</div>