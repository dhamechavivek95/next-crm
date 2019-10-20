<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BankDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-detail-form">

    <?php $form = ActiveForm::begin(); ?>
     <div class="panel">
          <div class="panel-heading"><?= $this->title ?></div>
          <div class="item-form col-sm-offset-1">

            <div class="row">
                <div class="form-group input-sm">
                <?= $form->field($model, 'bank_name',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                <?= $form->field($model, 'branch_name',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                <?= $form->field($model, 'account_no',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
            </div>
        </div>
        <hr>
            <div class="row">
                <div class="form-group input-sm">

                <?= $form->field($model, 'account_type',['options' => ['class' => 'col-sm-3']])->dropdownList([
                    'SAVING' => 'Saving', 'CURRENT' => 'Current'],['maxlength' => true,'class' => 'input-sm form-control','prompt' => 'Select']) ?>

                <?= $form->field($model, 'ifsc_code',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
            </div>
        </div>
<div class="break-rule"></div>
    <div class="row">
     <div class="col-sm-offset-5">
        <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        <?= Html::a('Cancel','index', ['class' => 'btn btn-danger']) ?>
    </div>
        </div>
    </div>
</div>
</div>

    <?php ActiveForm::end(); ?>

</div>
</div>
