<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oper".
 *
 * @property string $id
 * @property string $ordid
 * @property string $make
 * @property string $code
 * @property string $Name
 * @property string $region
 * @property double $quan
 * @property double $price
 * @property string $currency
 * @property double $koeff
 * @property string $supplierid
 * @property double $supplierquan
 * @property double $supplierprice
 * @property string $weightGr
 * @property string $subst
 * @property string $agry
 * @property string $brand
 * @property string $wait
 * @property string $container
 * @property string $dpc
 * @property string $updated_at
 * @property string $stock
 * @property string $minquan
 * @property string $pack
 *
 * @property Orders $ord
 */
class oper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oper';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ordid', 'supplierid', 'weightGr', 'dpc', 'stock', 'minquan','userid'], 'integer'],
            [['make', 'code', 'Name', 'region', 'updated_at', 'stock','userid'], 'required'],
            [['quan', 'price', 'koeff', 'supplierquan', 'supplierprice'], 'number'],
            [['updated_at'], 'safe'],
            [['make'], 'string', 'max' => 100],
            [['code', 'region', 'pack'], 'string', 'max' => 64],
            [['Name'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 3],
            [['subst'], 'string', 'max' => 300],
            [['agry', 'brand', 'wait', 'container'], 'boolean'],
            [['ordid'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['ordid' => 'id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ordid' => 'Ordid',
            'make' => 'Make',
            'code' => 'Code',
            'Name' => 'Name',
            'region' => 'Region',
            'quan' => 'Quan',
            'price' => 'Price',
            'currency' => 'Currency',
            'koeff' => 'Koeff',
            'supplierid' => 'Supplierid',
            'supplierquan' => 'Supplierquan',
            'supplierprice' => 'Supplierprice',
            'weightGr' => 'Weight Gr',
            'subst' => 'Subst',
            'agry' => 'Agry',
            'brand' => 'Brand',
            'wait' => 'Wait',
            'container' => 'Container',
            'dpc' => 'Dpc',
            'updated_at' => 'Updated At',
            'stock' => 'Stock',
            'minquan' => 'Minquan',
            'pack' => 'Pack',
            'userid' => 'Клиент'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrd()
    {
        return $this->hasOne(Orders::className(), ['id' => 'ordid']);
    }
}
