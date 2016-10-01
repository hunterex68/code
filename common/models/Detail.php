<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 28.09.2016
 * Time: 22:12
 */

namespace common\models;


class Detail
{
	public $brand;
	public $code;
	public $description;

	public function rules()
	{
		return [

			[['brand','code','description'],'trim'],
			['code','match,\'pattern\' => \'/^[A-Za-z0-9]$/'],
			['code','required'],
		];
	}

}