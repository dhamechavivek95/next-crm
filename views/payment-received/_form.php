<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Contact;
use app\models\BankDetails;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-details-form">

    <?php $form = ActiveForm::begin([
            'id' => 'payment-received-active-form'
    ]); ?>

    <div class="panel">
        <div class="panel-heading"><?= $this->title ?></div>

        <div class="row">
            <div class="form-group input-sm">
                <?= $form->field($model, 'bank_id',['options' => ['class' => ['col-sm-3 input-sm']]])->dropDownList(ArrayHelper::map(BankDetails::find()->all(),'bank_id','bank_name'),['prompt' => 'Select','class' => 'select2']); ?>

                <?= $form->field($model, 'user_id',['options' => ['class' => ['col-sm-3 input-sm']]])->dropDownList(ArrayHelper::map(Contact::find()->where(['contact_type' => 'CUSTOMER'])->all(),'contact_id','display_name'),['prompt' => 'Select','class' => 'select2'])->label('Customer') ?>

                <?= $form->field($model, 'created_at',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['class' => 'form-control start-date']) ?>

                <?= $form->field($model, 'description',['options' => ['class' => ['col-sm-3 input-sm']]])->textarea(['rows' => 2]) ?>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="form-group input-sm">

            <?= $form->field($model, 'amount',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true,'onkeypress' =>"return isNumberKey(event)"]) ?>

                <?= $form->field($model, 'payment_type',['options' => ['class' => ['col-sm-3 input-sm']]])->dropDownList([ 'CASH' => 'CASH', 'CARD' => 'CARD', 'CHEQUE' => 'CHEQUE', 'NET BANKING' => 'NET BANKING', ], ['prompt' => 'Select']) ?>

            </div>
        </div>
        <br><br>
        <div id="cheque-details">
            <div class="row">
                <div class="form-group input-sm">
                <?= $form->field($model, 'cheque_no',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'cheque_due',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true,'class' => 'start-date form-control']) ?>
                <?= $form->field($model, 'cheque_type',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div id="netbank-details">
            <div class="row">
                <div class="form-group input-sm">
                <?= $form->field($model, 'transaction_id',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'net_username',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'net_mob_no',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <br><br>
    </div>

    <div class="portlet">
        <div id="portlet2" class="panel-collapse collapse in">
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice Number</th>
                                <th>Invoice Amount</th>
                                <th>Due Amount</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody id="bodyData">
                            <tr>
                            <td>There are no bills applied for this payment.</td>
                            <tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="col-sm-offset-9">
                        <label class="mt-14">Total : </label>
                        <div class="input-sm col-sm-9 pull-right">
                            <h4 id="total-payment-made" class="pull-right"></h4>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
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
    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
<?php
$this->registerJsFile('@web/js/payment-received.js', [
    'depends' => [\app\assets\NextAppAsset::className()]
]);
?>