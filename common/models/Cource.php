<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Curce".
 *
 * @property double $USD
 * @property double $EUR
 */
class Cource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Curce';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USD', 'EUR'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USD' => 'Usd',
            'EUR' => 'Eur',
        ];
    }
}
