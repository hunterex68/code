<?
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class searchFormWidget extends Widget
{
	public $header1;
	public $header2;
	public $data;

	public function init()
	{

	}

	public function run()
	{
		if(!empty($this->header1))
			$this->data['header1'] = $this->header1;
		if(!empty($this->header2))
			$this->data['header2'] = $this->header2;

		return $this->render('helloBlock',['model'=>$this->data]);
	}
}