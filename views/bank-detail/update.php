<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BankDetail */

$this->title = 'Update Bank Detail: ' . $model->bank_id;
$this->params['breadcrumbs'][] = ['label' => 'Bank Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bank_id, 'url' => ['view', 'id' => $model->bank_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-detail-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
