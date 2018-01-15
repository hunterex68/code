<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usersgroups".
 *
 * @property integer $id
 * @property string $Description
 * @property double $kUAE
 * @property double $kUSA
 * @property double $kUA
 * @property double $kEUR
 * @property double $kPLND
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
}
