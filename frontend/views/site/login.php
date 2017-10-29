<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container" id="body">
        <div class="row">
            <div class="col-lg-5">
                  <div class="site-login">
                    <?= yii\widgets\Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <h1><?= Html::encode($this->title) ?></h1>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    
                    <?= $form->field($model, 'password')->passwordInput() ?>
    
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
    
                    <div style="color:#999;margin:1em 0">
                        //Если Вы забыли пароль можете <?= Html::a(' сбросить его', ['site/request-password-reset']) ?>.
                        Если Вы забыли пароль можете <?= Html::a(' сбросить его', ['site/send-email']) ?>.
                    </div>
    
                    <div class="form-group">
                        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
    
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>