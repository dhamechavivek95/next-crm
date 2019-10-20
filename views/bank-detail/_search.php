<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BankDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'bank_id') ?>

    <?= $form->field($model, 'bank_name') ?>

    <?= $form->field($model, 'branch_name') ?>

    <?= $form->field($model, 'account_no') ?>

    <?= $form->field($model, 'account_type') ?>

    <?php // echo $form->field($model, 'ifsc_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
