<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'item_unit') ?>

    <?= $form->field($model, 'item_type') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'tax_type') ?>

    <?php // echo $form->field($model, 'hsn') ?>

    <?php // echo $form->field($model, 'sales_rate') ?>

    <?php // echo $form->field($model, 'sales_account') ?>

    <?php // echo $form->field($model, 'sales_desc') ?>

    <?php // echo $form->field($model, 'purchase_rate') ?>

    <?php // echo $form->field($model, 'purchase_account') ?>

    <?php // echo $form->field($model, 'purchase_desc') ?>

    <?php // echo $form->field($model, 'is_trackable') ?>

    <?php // echo $form->field($model, 'opening_stock') ?>

    <?php // echo $form->field($model, 'opening_stock_rate') ?>

    <?php // echo $form->field($model, 'stock_amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
