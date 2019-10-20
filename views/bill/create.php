<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BillMaster */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-master-create">

    <?= $this->render('_form', [
        'model' => $model,
        'itemsData' => $itemsData,
        'extraItemsData' => $extraItemsData,
        'itemError' => $itemError,
        'extraError' => $extraError,
    ]) ?>

</div>
