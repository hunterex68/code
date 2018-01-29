<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php if(Yii::$app->session->hasFlash('error')):

    ?>

    <div class="alert alert-warning">

        <?php

        Yii::$app->session->getFlash('error');

        ?>

    </div>

    <?php
endif;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h1>
            <?php
            echo Yii::t('app','Форма регистрации');
            ?>
        </h1>
    <?php
    $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email') ?>
        <div class="form-group">
            <div>
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
    </div>
</div>