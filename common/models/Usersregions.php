<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usersregions".
 *
 * @property integer $id
 * @property string $Name
 * @property integer $parentID
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
            'Name' => 'Название',
            'parentID' => 'Областнй центр',
        ];
    }
}
