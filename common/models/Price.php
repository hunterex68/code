<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 01.10.2016
 * Time: 19:02
 */

namespace common\models;


class Price
{
	public $detail;
	public $quan;
	public $price;
	public $stock;
	public $delivery;
	public $statistic;

	public function rules()
	{
		return [

			['quan','integer','min'=>1],
			[['quan','price','detail'],'required'],
		];
	}
}