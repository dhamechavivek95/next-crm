<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="form-group">
            <?= $form->field($model, 'first_name',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'class' => 'form-control']) ?>

            <?= $form->field($model, 'last_name',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class="form-group">

            <?= $form->field($model, 'email',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'contact_number',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">

            <?= $form->field($model, 'other',['options' => ['class' => 'col-md-6']])->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'address',['options' => ['class' => 'col-md-6']])->textarea(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class="form-group">

            <?= $form->field($model, 'website',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="break-rule"></div>
    <div class="col-sm-offset-5">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>

            <?= Html::a('Cancel','index', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
