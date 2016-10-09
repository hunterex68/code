<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 07.10.2016
 * Time: 19:06
 */

namespace common\models;

use SoapClient;

class Brands
{
	public $code;

	function __construct($num)
	{
		if (!empty($num))
			$this->code = preg_replace('/[^A-Za-z0-9\.]/', '', $num);
	}

	function All()
	{
		$host = "http://5.9.77.6/ws.asmx?WSDL";
		$client = new SoapClient($host);
		$res = null;
		$params = array("num" => $this->code);
		$res = $client->GetBrands($params);
		if (!is_array($res->GetBrandsResult->string))
			$str[0] = $res->GetBrandsResult->string;
		else
			$str = $res->GetBrandsResult->string;
		$result = [];
		foreach($str as $st) {
			$val=explode(':',$st);
			$result[] = $val[0];
				}
		return $result;
	}
}
