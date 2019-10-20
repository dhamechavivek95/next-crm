<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BankDetail */

$this->title = 'Create Bank Detail';
$this->params['breadcrumbs'][] = ['label' => 'Bank Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-detail-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
