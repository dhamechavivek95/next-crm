<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = 'Update Vendor';
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->display_name, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contact-update">
    <?= $this->render('_form', [
        	'model' => $model,
            'address' => $address,
    ]) ?>

</div>
