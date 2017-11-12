<?php

namespace app\models;

use Yii;
use SoapClient;
use SoapFault;
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
	var $cnt = '';
	var $buf = '';

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
			[['quan', 'client_id','term'], 'integer'],
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
			'term' => 'Срок доставки'
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

	public function getParts($code, $brand = '')
	{

		$this->buf = Yii::$app->db->createCommand('SELECT brand, code,description,quan,price FROM stock WHERE singlecode=:sc ' . ($brand != '' ? 'and brand = :br' : ''))
			->bindValue(':sc', $code)
			->bindValue(':br', $brand)
			->queryAll();
		return $this->buf;
	}

	public static function getPrice($hash)
	{
		$hash = "'" . str_replace('#', "','", $hash) . "'";

		$q = 'SELECT brand, code,description,quan,price,term,client_id FROM stock WHERE upper(concat(brand,":",replace(singlecode,"*",""))) in (' . $hash . ')';
		$res = Yii::$app->db->createCommand($q)
		->queryAll();
		return $res;
	}

	public static function getCode($code)
	{
		$list = Stock::find()
			->select(['count(code) as cnt', 'code', 'brand'])
			->where("code like '%" . $code . "%'")
			->groupby('code,brand')
			->All();
		return $list;
	}
	public static function Analogs($oem,$brand)
	{
		$arr = [];
		$host = Yii::$app->params['LanaAnalogsUrl'];
		$client = new SoapClient( $host );
		$res = null;
		$params = array( "brend" => $brand, "num" => $oem );
		$res = $client->GetList( $params );

		if (!is_array( $res->GetListResult->string ) )
			$arr[0] = $res->GetListResult->string;
		else
			$arr = $res->GetListResult->string;
		return $arr;
	}
}
