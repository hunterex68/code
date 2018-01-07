<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carriers".
 *
 * @property string $id
 * @property string $Name
 * @property string $Stock
 */
class Carriers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carriers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'string', 'max' => 128],
            [['Stock'], 'string', 'max' => 255],
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
            'Stock' => 'Stock',
        ];
    }
}
