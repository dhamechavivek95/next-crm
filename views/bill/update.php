<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */

$this->title = Yii::t('app', 'Update Bill Master: ' . $model->bill_id, [
    'nameAttribute' => '' . $model->bill_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill Masters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bill_id, 'url' => ['view', 'id' => $model->bill_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bill-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
