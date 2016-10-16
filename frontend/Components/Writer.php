<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 16.10.2016
 * Time: 18:05
 */

namespace app\components;


use yii\helpers\Html;

class Writer
{

	public $columns=[];
	public $caption;

	function __construct()
	{

	}

	function header()
	{
		$h='';
		if(!empty($this->columns)) {
			$h = "<tr>";
			foreach ($this->columns as $key=>$val) {

				$h .= "<th>";
				$h .= $val;
				$h .= "</th>";
			}
			$h .= "</tr>";
		}
		return $h;
	}

	function renderTable($data)
	{
		if(is_array($data))
		{
			//Html::tag('table', implode("\n", $content), ["class"=>"table"]);
			$h = $this->caption."<table class='table'><thead>".$this->header()."</thead><tbody>";
			$outline='';
			if(!empty($data)) {
				foreach ($data as $res) {
					$outline .= "<tr>";
					foreach ($this->columns as $key=>$val) {
						if($key[0]!='!')
							$outline .= "<td>" . $res->$key . "</td>";
						else
							$outline .= "<td>" . substr($key,1,strlen($key)-1) . "</td>";
					}
					$outline .= "</tr>";
				}
			}
			echo $h.$outline."</tbody></table>";
		}
	}
}