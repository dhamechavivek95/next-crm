<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper-page animated fadeInDown">
    <div class="panel panel-color panel-primary">
        <div class="panel-heading">
            <h3 class="text-center m-t-10"><?= Html::encode($this->title) ?></h3>
        </div>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-horizontal m-t-40']]); ?>

        <?= $form->field($model, 'username', ['inputTemplate' => '<div class="form-group"><div class="col-xs-12">{input}</div></div>','enableLabel' => false])->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'username (must be Email-id)']) ?>

        <?= $form->field($model, 'password', ['inputTemplate' => '<div class="form-group"><div class="col-xs-12">{input}</div></div>','enableLabel' => false])->passwordInput(['class' => 'form-control', 'placeholder' => 'password']) ?>

        <div class="form-group text-right">
            <div class="col-xs-12">
                <?= Html::submitButton('Log In', ['class' => 'btn btn-purple w-md', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
