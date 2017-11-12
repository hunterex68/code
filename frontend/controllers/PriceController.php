<?php

	namespace frontend\controllers;

	use Yii;
	use yii\web\Controller;

	use app\models\Stock;

	class PriceController extends Controller
	{

		public $layout = 'priceLayout';

		public function init()
		{
			if(Yii::$app->user->isGuest)
			{
				$this->layout = 'main';
			}
		}
		/* public function behaviors()
		 {
			 return [
				 [
					 'class' => ContentNegotiator::className(),
					 'only' => ['find','findStock'],
					 'formats' => [
						 'application/json' => Response::FORMAT_JSON,
					 ],
			 ],
		 ];
		 }*/
		public function actionIndex()
		{
			$this->view->registerCssFile('/css/shortPage.css');
			return $this->render('index');
		}

		/**
		 * @param $oem
		 * @param string $brand
		 * @return string
		 */
		public function actionFind($oem, $brand = '')
		{
			//print_r(Yii::$app->params['brands']);die('OEM = '.$oem." BRAND = ".$brand);
			if (empty($brand)) {
				//если бренд не определен делам запрос на сервис
				// для получения списка производителей
				$br = [];
				//перебираем все источники и в каждом запускаем getBrands($oem)

				foreach (Yii::$app->params['brands'] as $srv) {

					$arr = Yii::$app->$srv->getBrands($oem);

					for ($i = 0; $i < count($arr); $i++)
						$br[] = $arr[$i];
				}

				if (count($br) > 0) {
					$br = array_unique($br);
					$this->view->registerCssFile('/css/shortPage.css');
					return $this->render('listbrands', ['dataProvider' => $br, 'code' => $oem]);
				}
			}
			else
				$this->view->registerCssFile('/css/longPage.css');

			return $this->render('result', ['code' => $oem,'brands' => $brand]);
		}

		public function actionFindStock()
		{
			return ['result' => '1'];
		}

		public function actionGetCodeFromBase($code)
		{
			$list = [];
			if (!empty($code)) {
				$list = Stock::getCode($code);
			}

			$data = [];
			foreach ($list as $item) {
				//$statePresent = 'present';
				array_push($data, ['value' => $item->code, 'code' => $item->code, 'brand' => $item->brand, 'cnt' => $item->cnt]);
			}
			//Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return json_encode($data);
		}

		public function actionStock()
		{
			return $this->action;
		}

	}
