
<div class="title toptitle">
	<div class="container">
		<div class="row">
			<? if(!empty($model['header1'])):?>
				<h1 class="hidden-xs">Все, что Вам нужно находится здесь!</h1>
			<? endif ?>
			<? if(!empty($model['header2'])):?>
				<h2 class="hidden-xs">любые запчасти на автомобиль.</h2>
			<? endif ?>
			<div class="col-md-6 panel-body bg-success" >
				<form action="price/find" method = 'get' class="form-inline" role="form">
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
			<script type="text/javascript">
				/*function submitForm() {
					$.when(
						$.ajax('price/find?oem=MN100250&csrf-token=VHZ2UVdrVGURJx0CIy0QAhxDPjA0ORoVJiwsJjMxE1wjESQEMzo1LA=='),
						$.ajax('price/find?oem=MN100250&csrf-token=VHZ2UVdrVGURJx0CIy0QAhxDPjA0ORoVJiwsJjMxE1wjESQEMzo1LA==')
					).then(function (result1, result2) {
						console.log(result1);
						console.debug(result2);
					});
				}*/
			</script>
			<div class="col-md-6 panel-body bg-info">

				<form action = '<?echo $model['controller'];?>find' class="form-inline" role="form">
					<input type="text" name="oem" value="" class="form-control" id="oem" placeholder="Код детали">

					<button type="submit" class="btn btn-primary">
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