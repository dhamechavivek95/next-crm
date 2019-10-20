<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel">
        <div class="panel-heading"><?= $this->title ?></div>
        <div class="contact-form col-sm-offset-1">

            <div class="row">
                <div class="form-group input-sm">
                    <?= $form->field($model, 'cat_name',['options' => ['class' => 'col-sm-5']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                    <?= $form->field($model, 'cat_desc',['options' => ['class' => 'col-md-5']])->textarea(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                </div>
            </div>

            <div class="break-rule"></div>
            <div class="row">
             <div class="col-sm-offset-5">
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>

                    <?= Html::a('Cancel','index', ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
            </div></div>

    <?php ActiveForm::end(); ?>

</div>
