<?
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class searchFormWidget extends Widget
{
	public $header1;
	public $header2;
	public $data;
	public $place;

	public function init()
	{

	}

	public function run()
	{

		$this->data['header1'] = !empty($this->header1)?$this->header1:'';
		$this->data['header2'] = !empty($this->header2)?$this->header2:'';
		$this->data['place'] = !empty($this->place)?$this->place:'';

		return $this->render('helloBlock',['model'=>$this->data]);
	}
}