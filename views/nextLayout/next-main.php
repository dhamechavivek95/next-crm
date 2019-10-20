<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\NextAppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;

NextAppAsset::register($this);
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
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic'
          rel='stylesheet'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Navigation Panel Start -->
<?php echo $this->render('sections/navigation'); ?>
<!-- Navigation Panel end -->
<!-- Main Content Start -->
<section class="content">
    <!-- Header Start -->
    <?php echo $this->render('sections/header'); ?>
    <!-- Header End -->

    <!-- Main Content Start -->
    <div class="wraper container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>        
        <?= $content ?>
    </div>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <?php echo $this->render('sections/footer'); ?>
    <!-- Footer Ends -->
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
