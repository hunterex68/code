<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usersmetadata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usersmetadata-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= Html::hiddenInput('Usersmetadata[userid]',$id); ?>

    <?= $form->field($model, 'RegionID')->dropDownList(\yii\helpers\ArrayHelper::map(\frontend\models\usersregions::find()->all(), 'id', 'Name')) ?>

    <?= $form->field($model, 'Address')->textInput(['maxlength' => true,'required'=>true,]) ?>

    <?= $form->field($model, 'CarrierID')->dropDownList(\yii\helpers\ArrayHelper::map(\frontend\models\carriers::find()->all(), 'id', 'Name')) ?>

    <?= $form->field($model, 'Recipient')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
