<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usersgroups".
 *
 * @property string $id
 * @property string $Description
 * @property double $kUAE
 * @property double $kUSA
 * @property double $kUA
 * @property double $kEUR
 * @property double $kPLND
 *
 * @property Usersmetadata[] $usersmetadatas
 */
class Usersgroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usersgroups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kUAE', 'kUSA', 'kUA', 'kEUR', 'kPLND'], 'required'],
            [['kUAE', 'kUSA', 'kUA', 'kEUR', 'kPLND'], 'number'],
            [['Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Description' => 'Description',
            'kUAE' => 'K Uae',
            'kUSA' => 'K Usa',
            'kUA' => 'K Ua',
            'kEUR' => 'K Eur',
            'kPLND' => 'K Plnd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersmetadatas()
    {
        return $this->hasMany(Usersmetadata::className(), ['GroupID' => 'id']);
    }
}
