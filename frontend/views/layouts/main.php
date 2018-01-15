<?
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\components\searchFormWidget;
AppAsset::register($this);
//\yii\web\JqueryAsset::register($this);
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="Сайт автозапчастей"/>
	<link rel="icon" href="/favicon.png"/>
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<header class="top-header">

	<div class="row">
		<div class="col-md-4 top_links">
			<button class="client-icon hidden-md hidden-lg hidden-sm">
				<i class="glyphicon glyphicon-user"></i>
			</button>
			<a href="basket" class="basket">
				<i class="glyphicon glyphicon-shopping-cart"></i>
			</a>
			<div class="basket-counter"><span id="counter">0</span></div>
		</div>
		<div class="col-md-3 soc_buttons">
			<a href="https://www.facebook.com/sharer.php?u=http://part.com.ua/get-assisted-experts-stay-loaded-online"
			   target="_blank" class="social-icon"><span class="symbol">facebook</span></a>
			<a href="https://twitter.com/share?url=http://part.com.ua/get-assisted-experts-stay-loaded-online"
			   target="_blank" class="social-icon"><span class="symbol">twitter</span></a>
			<a href="https://plus.google.com/share?url=http://part.com.ua/get-assisted-experts-stay-loaded-online"
			   target="_blank" class="social-icon"><span class="symbol">googleplus</span></a>
			<a href="https://pinterest.com/pin/create/bookmarklet/?url=http://part.com.ua/get-assisted-experts-stay-loaded-online&description=Get%20Assisted%20By%20Experts%20To%20Stay%20Loaded%20Online!"
			   target="_blank" class="social-icon"><span class="symbol">pinterest</span></a>
		</div>
	</div>

</header>
<header class="middle-header">
	<div class="row">
		<div class="hdr">
			<div class="container">
				<div class='col-md-2 logo'>
					PartCom
				</div>
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
								<?= Html::a(Yii::t('app',"Главная"),"/",["class"=>"nav-link"]); ?>
							</li>
							<li>
								<?= Html::a(Yii::t('app',"Каталоги"),Url::toRoute('catalogs'),["class"=>"nav-link"]); ?>
							</li>

							<li>
								<?= Html::a(Yii::t('app',"Контакты"),Url::toRoute('contacts'),["class"=>"nav-link"]); ?>
							</li>

							<li id="enter">

								<?
								if(Yii::$app->user->isGuest)
									echo Html::a("Вход", Url::toRoute('site/login'), [
										'data' => ['method' => 'post'],
										'class' => 'white text-center',
									]);
								else
									echo Html::a("Выход", Url::toRoute('site/logout'), [
										'data' => ['method' => 'post'],
										'class' => 'white text-center',
									]);
								?>

							</li>

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
<div class="wrap">
	<div class="container-fluid">

		<?php echo  searchFormWidget::widget([
			'header1'=>'Все, что Вам нужно находится здесь!',
			'header2'=>'любые запчасти на автомобиль.',
			'controller'=>'price/',
		]);?>
		<?= $content ?>
		<?php
		foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		}
		?>
	</div>
</div>
<div class="clearfix"></div>
<div class="container-fluid">
	<div class="row">
		<footer id="footer">
			<div class="col-md-4" style=" color: #FFF;  padding: 10px;">
				<strong>Расписание работы</strong><br/>
				Понедельник - пятница:<br/>с 9:00 до 17:00 (GMT +2)<br/>
				Воскресенье: выходной день<br/>
				Тел: +3801231231212<br/>
				<strong>Обработка заказов -&nbsp;</strong>круглосуточно<br/>
			</div>
			<div class="col-md-4">
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
			<div class="col-md-4">
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
		</footer>
	</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


