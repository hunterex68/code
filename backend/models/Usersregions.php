<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usersregions".
 *
 * @property string $id
 * @property string $Name
 * @property integer $parentID
 *
 * @property Usersmetadata[] $usersmetadatas
 */
class Usersregions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usersregions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['parentID'], 'integer'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'parentID' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersmetadatas()
    {
        return $this->hasMany(Usersmetadata::className(), ['RegionID' => 'id']);
    }
}
