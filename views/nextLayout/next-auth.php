<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\WcAppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

WcAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Google-Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <!-- Content Start -->
    <?= Alert::widget() ?>
    <?= $content ?>
    <!-- Content End -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
