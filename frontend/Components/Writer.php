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
			$h = "<tr class='bg-primary'>";
			//print_r($this->columns);
			//die();
			foreach ($this->columns as $val) {

				$h .= "<th>";
				$h .= $val['val'];
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
			$h = $this->caption."<table class='table table-hover' id='oae'><thead>".$this->header()."</thead><tbody>";
			$outline='';
			if(!empty($data)) {
				foreach ($data as $res) {
					$hash ='';
					foreach($res as $key=>$val)
						if($val!='control' && $val!='hash')
							$hash .= $key.":".$val."#";
					$outline .= "<tr>";
					foreach ($this->columns as $val) {

						if(empty($val['option']))
							$outline .= "<td>" . $res->$val['key'] . "</td>";
						else
							$outline .= "<td>" . sprintf($val['option'],$res->$val['key']) . "<input type='hidden' name='hash' value='" . strrev(base64_encode(strrev($hash))) . "'/></td>";
					}

					$outline .= "</tr>";
				}
			}
			echo $h.$outline."</tbody></table>";
		}
	}
}