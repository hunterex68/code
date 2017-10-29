<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Usersmetadata */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = ['label' => 'Регистрация::Шаг 1', 'url' => ['site/signup']];
$this->params['breadcrumbs'][] = $this->title.'::Шаг 2';
?>

<div class="container" id="body">
    <div class="row site-login">
        <?= yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-sm-offset-1">
            <h1>Регистрация</h1>
                <?= $this->render('_form', [
                    'model' => $model,'id'=>$id,
                ]) ?>
        </div>
    </div>
</div>