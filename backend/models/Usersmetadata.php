<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "usersmetadata".
 *
 * @property string $id
 * @property string $UserID
 * @property string $RegionID
 * @property string $Address
 * @property string $GroupID
 * @property string $CarrierID
 * @property string $Recipient
 *
 * @property Carriers $carrier
 * @property Usersgroups $group
 * @property Usersregions $region
 * @property User $user
 * @property Userspersonal[] $userspersonals
 */
class Usersmetadata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['UserID', 'RegionID', 'Address', 'CarrierID', 'Recipient'], 'required'],
            [['UserID', 'RegionID', 'GroupID', 'CarrierID'], 'integer'],
            [['Address', 'Recipient'], 'string', 'max' => 255],
            [['Address'], 'unique'],
            [['CarrierID'], 'exist', 'skipOnError' => true, 'targetClass' => Carriers::className(), 'targetAttribute' => ['CarrierID' => 'id']],
            [['GroupID'], 'exist', 'skipOnError' => true, 'targetClass' => Usersgroups::className(), 'targetAttribute' => ['GroupID' => 'id']],
            [['RegionID'], 'exist', 'skipOnError' => true, 'targetClass' => Usersregions::className(), 'targetAttribute' => ['RegionID' => 'id']],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'UserID' => 'User ID',
            'RegionID' => 'Регион',
            'Address' => 'Адрес',
            'GroupID' => 'Группа',
            'CarrierID' => 'Carrier ID',
            'Recipient' => 'Получатель',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrier()
    {
        return $this->hasOne(Carriers::className(), ['id' => 'CarrierID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Usersgroups::className(), ['id' => 'GroupID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Usersregions::className(), ['id' => 'RegionID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserspersonals()
    {
        return $this->hasMany(Userspersonal::className(), ['MetaDataID' => 'id']);
    }
}
