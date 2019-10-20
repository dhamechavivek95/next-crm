<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = 'Create Customer';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHead'] = $this->title;
?>
<div class="contact-create ">

    <?= $this->render('_form', [
        	'model' => $model,
            'address' => $address,
    ]) ?>

</div>
