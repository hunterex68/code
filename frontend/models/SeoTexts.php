<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "seoTexts".
 *
 * @property integer $id
 * @property string $groupName
 * @property string $header
 * @property string $paragraph
 */
class SeoTexts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seoTexts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['groupName'], 'string', 'max' => 150],
            [['header'], 'string', 'max' => 250],
            [['paragraph'], 'string', 'max' => 1050],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'groupName' => 'Group Name',
            'header' => 'Header',
            'paragraph' => 'Paragraph',
        ];
    }

    public function getMainSeoText()
    {
        return seoTexts::find()
            ->where(['groupName' => 'main'])
            ->one();
    }

    public function getSeoText()
    {
        return seoTexts::find()
            ->where(['groupName' => 'text'])
            ->all();
    }
}
