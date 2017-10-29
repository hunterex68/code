 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="links-image-form">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            
            <?= $form->field($file, 'file')->fileInput()->label('����') ?>
            <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
            <div class="col-md-3">
                <input type="checkbox" name="saveformat" id="sformat"/>
                <label for="sformat">��������� ��������� ������</label>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '��������' : '���������', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>