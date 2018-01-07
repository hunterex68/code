<?php

namespace common\models;

use Yii;
use frontend\models\Usersgroups;

/**
 * This is the model class for table "usersmetadata".
 *
 * @property integer $id
 * @property integer $UserID
 * @property integer $RegionID
 * @property string $Name
 * @property string $Address
 * @property integer $GroupID
 */
class Usersmetadata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $Address;

    public static function tableName()
    {
        return 'usersmetadata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Address', 'trim'],
            ['Address', 'unique',   'message' => 'Этот адрес уже зарегистрирован.'],
            ['Address', 'string', 'min' => 5, 'max' => 255],
            [['CarrierID', 'UserID', 'RegionID', 'GroupID','Address'], 'required'],
            [['CarrierID', 'id', 'UserID', 'RegionID', 'GroupID'], 'integer'],
            [['Recipient'], 'string', 'max' => 255],
        ];
    }
    public static function findByAddress($Address)
    {
        return static::findOne(['Address' => $Address]);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'UserID' => 'User ID',
            'RegionID' => 'Город',
            'Address' => 'Адрес',
            'GroupID' => 'Группа',
            'CarrierID' => 'Перевозчик',
            'Recipient' => 'Получатель'
        ];
    }

    public function register($post)
    {

        if(self::load($post) && self::validate() && self::save())
            return true;
        else {

            return false;
        }
    }

    public static function getKoeff($id)
    {
        $u = self::findOne(['UserID'=>$id]);
        return Usersgroups::findOne($u->GroupID);
    }
}
