<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Orders".
 *
 * @property string $id
 * @property string $Userid
 * @property string $Note
 * @property string $Created_at
 * @property string $OrdtypeId
 *
 * @property User $user
 * @property Oper[] $opers
 */
class orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Userid', 'OrdtypeId'], 'integer'],
            [['Created_at'], 'required'],
            [['Created_at'], 'safe'],
            [['Note'], 'string', 'max' => 255],
            [['Userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Userid' => 'Userid',
            'Note' => 'Note',
            'Created_at' => 'Created At',
            'OrdtypeId' => 'Ordtype ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'Userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpers()
    {
        return $this->hasMany(Oper::className(), ['ordid' => 'id']);
    }
}
