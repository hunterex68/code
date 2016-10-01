<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 01.10.2016
 * Time: 21:42
 */

namespace common\models;

use SoapClient;

class Customer
{
	public $userName;
	public $password;
}

class lanaServices
{
	public $host;
	public $params;
	public $code;
	private $client;

	function rules()
	{
		return [

			['code','trim'],
			['code','required'],
			['code','match,\'pattern\' => \'/^[A-Za-z0-9]$/'],

		];
	}

	function __construct($num)
	{

		$this->host = "http://emexonline.com:3000/MaximaWS/service.wsdl";
		$customer = new Customer();
		$customer->UserName = "QKHR";
		$customer->Password = "GFtUeeo3";
		$this->code=$num;
		$this->params = [ "Customer" =>$customer, "DetailNum" => $this->code,"ShowSubsts" => true ];
		$this->client = new SoapClient($this->host, ['exceptions' => 1,
			'cache_wsdl' => WSDL_CACHE_MEMORY,'timeout'=>10]);
	}

	public function getUAE()
	{
		$result = $this->client->SearchPart( $this->params );
		//print_r($result);
		return $result->SearchPartResult->FindByNumber;

	}
}