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
		$customer = new Customer();
		$customer->UserName = "QKHR";
		$customer->Password = "GFtUeeo3";
		$this->code=$num;
		$this->params = [ "Customer" =>$customer, "DetailNum" => $this->code,"ShowSubsts" => true ];
	}

	public function getUAE()
	{
		$this->host = "http://emexonline.com:3000/MaximaWS/service.wsdl";

		$this->client = new SoapClient($this->host, ['exceptions' => 1,
			'cache_wsdl' => WSDL_CACHE_MEMORY,'timeout'=>10]);
		$result = $this->client->SearchPart( $this->params );
		return $result->SearchPartResult->FindByNumber;

	}

	public function getReplaces($brand,$code)
	{
		$this->host = "http://5.9.77.6/ws.asmx?WSDL";
		$this->client = new SoapClient($this->host, ['exceptions' => 1,
			'cache_wsdl' => WSDL_CACHE_MEMORY,'timeout'=>10]);
		$params = array( "brend" => $brand, "num" => $code );
		$res = $this->client->GetList( $params );




		if ( ! is_array( $res->GetListResult->string ) )
			$_str[0] = $res->GetListResult->string;
		else
			$_str = $res->GetListResult->string;

		return $_str;
	}
}