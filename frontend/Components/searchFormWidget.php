<?
namespace frontend\components;

use yii\base\Widget;


class searchFormWidget extends Widget
{
	public $header1;
	public $header2;
	public $data;
	public $controller;

	public function init()
	{

	}

	public function run()
	{

		$this->data['header1'] = !empty($this->header1)?$this->header1:'';
		$this->data['header2'] = !empty($this->header2)?$this->header2:'';
		$this->data['controller'] = !empty($this->controller)?$this->controller:'';
		return $this->render('helloBlock',['model'=>$this->data]);

	}
}