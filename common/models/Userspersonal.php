<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userspersonal".
 *
 * @property integer $id
 * @property string $MetaDataID
 * @property string $Position
 * @property string $FirstName
 * @property string $LastName
 * @property string $Phone
 * @property string $Email
 * @property integer $PositionType
 *
 * @property Usersmetadata $metaData
 */
class Userspersonal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userspersonal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MetaDataID', 'Phone', 'PositionType'], 'required'],
            [['MetaDataID', 'PositionType'], 'integer'],
            [['Position', 'FirstName', 'LastName'], 'string', 'max' => 255],
            [['Phone'], 'string', 'max' => 16],
            [['Email'], 'string', 'max' => 128],
            [['MetaDataID'], 'exist', 'skipOnError' => true, 'targetClass' => Usersmetadata::className(), 'targetAttribute' => ['MetaDataID' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'MetaDataID' => 'Meta Data ID',
            'Position' => 'Position',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Phone' => 'Phone',
            'Email' => 'Email',
            'PositionType' => 'Position Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetaData()
    {
        return $this->hasOne(Usersmetadata::className(), ['id' => 'MetaDataID']);
    }
}
