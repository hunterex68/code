<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property string $brand
 * @property string $code
 * @property string $singlecode
 * @property string $description
 * @property integer $quan
 * @property double $price
 * @property integer $client_id
 * @property string $inDate
 */
class Stock extends \yii\db\ActiveRecord
{
	var $cnt='';
	var $buf='';
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'stock';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['quan', 'client_id'], 'integer'],
			[['price'], 'number'],
			[['inDate'], 'safe'],
			[['brand'], 'string', 'max' => 50],
			[['code', 'singlecode'], 'string', 'max' => 128],
			[['description'], 'string', 'max' => 256],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'brand' => 'Brand',
			'code' => 'Code',
			'singlecode' => 'Singlecode',
			'description' => 'Description',
			'quan' => 'Quan',
			'price' => 'Price',
			'client_id' => 'Client ID',
			'inDate' => 'In Date',
		];
	}

	public function getBrands($code)
	{
		$res = Yii::$app->db->createCommand('SELECT count(brand) as cnt,brand FROM stock WHERE singlecode=:sc group by brand')
			->bindValue(':sc', $code)
			->queryAll();

		$arr = [];
		foreach ($res as $val) {
			$arr[] = $val['brand'];
		}

		return $arr;
	}

	public function getParts($code,$brand='')
	{

		$this->buf = Yii::$app->db->createCommand('SELECT brand, code,description,quan,price FROM stock WHERE singlecode=:sc '.($brand!=''?'and brand = :br':''))
			->bindValue(':sc', $code)
			->bindValue(':br',$brand)
			->queryAll();
		return $this->buf;
	}

	public function getPrice($hash)
	{
		$hash = "'".str_replace('#',"','",$hash)."'";
		//$arr = explode(',',$hash);
		print_r($hash);
		//die();
		$res = Yii::$app->db->createCommand('SELECT brand, code,description,quan,price FROM stock WHERE concat(brand,":",code) in ('.$hash.')')
			//->bindValue(':arr', $hash)
			->queryAll();
		print_r($res);die;
		return $res;
	}
	public static function getCode($code)
	{
		$list = Stock::find()
			->select(['count(code) as cnt','code','brand'])
			->where("code like '%".$code."%'")
			->groupby('code,brand')
			->All();
		return $list;
	}
}
