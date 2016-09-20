<?
use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
//\yii\web\JqueryAsset::register($this);

$this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Сайт автозапчастей"/>
	<link rel="icon" href="/favicon.png"/>
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>

</head>
<body>
<?php $this->beginBody(); ?>
<header class="top-header">
	<div class="container">
		<div class="row">

			<div class="col-md-4 top_links">
				<button class="client-icon hidden-md hidden-lg hidden-sm">
					<i class="glyphicon glyphicon-user"></i>
				</button>
				<button href="basket" class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</button>
				<div class="basket-counter"><span id="counter">0</span></div>
				<div class="auth-links">
					<a href="#">Вход</a>/<a href="#">Регистрация</a>
				</div>
			</div>

			<div class="col-md-3 soc_buttons">
				<a href="https://www.facebook.com/sharer.php?u=http://part.com.ua/get-assisted-experts-stay-loaded-online"
				   target="_blank" class="social-icon"><span class="symbol">facebook</span></a>
				<a href="https://twitter.com/share?url=http://part.com.ua/get-assisted-experts-stay-loaded-online"
				   target="_blank" class="social-icon"><span class="symbol">twitter</span></a>
				<a href="https://plus.google.com/share?url=http://part.com.ua/get-assisted-experts-stay-loaded-online"
				   target="_blank" class="social-icon"><span class="symbol">googleplus</span></a>
				<a href="https://pinterest.com/pin/create/bookmarklet/?url=http://part.com.ua/get-assisted-experts-stay-loaded-online&description=Get%20Assisted%20By%20Experts%20To%20Stay%20Loaded%20Online!"
				   target="_blank" class="social-icon"><span class="symbol">pinterest</span></i></a>
			</div>
		</div>
	</div>
</header>
<header class="middle-header">
	<div class="container">
		<div class="row">
			<div class="hdr clearfix">
				<div class='col-md-2 logo'>LANA</div>

				<div class="col-md-3 col-md-push-7 rightphone hidden-xs">
					<div class="phones">
						<div class="phone">
							<i class="glyphicon glyphicon-phone"></i>
							+38 (050)32-555-23
						</div>
						<div class="phone">
							<i class="glyphicon glyphicon-phone"></i>
							+38 (067)67-67-464
						</div>
						<div class="phone">
							<i class="glyphicon glyphicon-phone"></i>
							+38 (093)939-68-68
						</div>
						<a href="#" class="callback">Заказать обратный вызов</a>
					</div>
				</div>
				<div class="col-md-7 col-md-pull-3 hidden-xs">
					<nav style="text-align: center" class="clearfix">
						<ul class="main-menu">
							<li class="active">
								<a class="nav-link" href="javascript:;">Главная</a>
							</li>
							<li>
								<a class="nav-link" href="javascript:;">Каталоги</a>
							</li>
							<li>
								<a class="nav-link" href="/site/about">О нас</a>
							</li>
							<li>
								<a href="/site/contact">Контакты</a>
							</li>

							<li id="enter"><a class="nav-link disabled" href="/site/login">Вход</a></li>

						</ul>
					</nav>

				</div>
				<div id='sandwich' class='hidden-lg hidden-md hidden-sm'>
					<div class='sw-topper'></div>
					<div class='sw-bottom'></div>
					<div class='sw-footer'></div>
				</div>
			</div>
		</div>
	</div>
</header>

<?= $content ?>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-4" style=" color: #FFF;  padding: 10px;">


				<strong>Расписание работы</strong><br>
				Понедельник - пятница:<br>с 9:00 до 17:00 (GMT +2)<br>
				Воскресенье: выходной день<br>
				Тел: +3801231231212<br>
				<strong>Обработка заказов -&nbsp;</strong>круглосуточно<br>


			</div>
			<div class="col-md-2">
				<ul>
					<li>
						<a href="/instructions/how_to_begin">Как начать работу</a></li>
					<li>
						<a href="/instructions/how_to_order/search">Как искать товар</a></li>
					<li>
						<a href="/instructions/how_to_order/basket">Как работать с корзиной</a></li>
					<li>
						<a href="/instructions/how_to_order/order">Как оформить заказ</a></li>
					<li>
						<a href="/instructions/how_to_pay">Как оплатить заказ</a></li>
					<li>
						<a href="/instructions/how_to_send">Как отправить товар</a></li>
					<li>
						<a href="/instructions/how_to_ask_question">Как задать вопрос менеджеру</a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<ul>
					<li>
						<a href="/instructions/discount_sheet">Объемные скидки</a></li>
					<li>
						<a href="/instructions/pricelists_sheet">Типы прайслистов</a></li>
					<li>
						<a href="/instructions/web_services">Веб-сервисы</a></li>
					<li>
						<a href="/Page/termsandconditions">Договор сотрудничества</a></li>
					<li>
						<a href="/Page/about">О компании</a></li>
					<li>
						<a href="/Page/contacts">Контакты</a></li>
					<li>
						<a href="/ContentList/site_news">Архив новостей</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="pull-left">&copy; PartCom <?= date('Y') ?></p>
			</div>
		</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


