<?php

namespace app\models;

use Yii;
//use common\models\User;

/**
 * This is the model class for table "fileformat".
 *
 * @property integer $id
 * @property string $UserId
 * @property integer $f1
 * @property integer $f2
 * @property integer $f3
 * @property integer $f4
 * @property integer $f5
 *
 * @property User $user
 */
class Fileformat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fileformat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'UserId'], 'required'],
            [['id', 'UserId', 'f1', 'f2', 'f3', 'f4', 'f5'], 'integer'],
         //   [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['UserId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'f1' => 'Производитель',
            'f2' => 'Код',
            'f3' => 'Описание',
            'f4' => 'Кол-во',
            'f5' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }

    public static function getFormat()
    {
        $query = Fileformat::find(['userId'=>\Yii::$app->user->identity->getId()])->asArray();

        return $query;
    }

}
