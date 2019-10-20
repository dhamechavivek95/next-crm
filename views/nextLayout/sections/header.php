<?php
/**
 * Created by PhpStorm.
 * User: akshay
 * Date: 30/12/17
 * Time: 1:32 AM
 */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<header class="top-head container-fluid">
    <button type="button" class="navbar-toggle pull-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <!-- Search -->
    <form role="search" class="navbar-left app-search pull-left hidden-xs">
        <input type="text" placeholder="Search..." class="form-control">
    </form>

    <!-- Left navbar -->
    <!--<nav class=" navbar-default hidden-xs" role="navigation">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">English <span class="caret"></span></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="#">German</a></li>
                    <li><a href="#">French</a></li>
                    <li><a href="#">Italian</a></li>
                    <li><a href="#">Spanish</a></li>
                </ul>
            </li>
        </ul>
    </nav>-->

    <!-- Right navbar -->
    <ul class="list-inline navbar-right top-menu top-right-menu">
        <!-- user login dropdown start-->
        <li class="dropdown text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="" class="img-circle profile-img thumb-sm">
                <span class="username"><?= Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->last_name?></span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu extended pro-menu fadeInUp animated" tabindex="5003"
                style="overflow: hidden; outline: none;">
                <li><a href="<?= Url::to(['admin/profile']) ?>"><i class="fa fa-briefcase"></i>Profile</a></li>

                <li><a href="#" onclick="document.getElementById('logout_form').submit();"><i class="fa fa-sign-out"></i>Logout</a></li>
                <?php
                    echo Html::beginForm(['/auth/logout'], 'post', ['id' => 'logout_form']);
                    echo Html::endForm();
                ?>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!-- End right navbar -->

</header>
<?php if(Yii::$app->session->hasFlash('success')) : ?>
<div class="notifyjs-corner" style="top: 0px; right: 0px;"><div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style=""></div>
  <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-success"><div class="image" data-notify-html="image"><i class="fa fa-check"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title"><?= Yii::$app->session->getFlash('success');?></div><div class="text" data-notify-html="text"></div></div></div></div>
</div></div>
<?php endif?>

<?php if(Yii::$app->session->hasFlash('info')) : ?>
<div class="notifyjs-corner" style="top: 0px; right: 0px;"><div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style=""></div>
  <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-info"><div class="image" data-notify-html="image"><i class="fa fa-question"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title"><?= Yii::$app->session->getFlash('info');?></div><div class="text" data-notify-html="text"></div></div></div></div>
</div></div>
<?php endif?>

<?php if(Yii::$app->session->hasFlash('warning')) : ?>
<div class="notifyjs-corner" style="top: 0px; right: 0px;"><div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style=""></div>
  <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-warning"><div class="image" data-notify-html="image"><i class="fa fa-warning"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title"><?= Yii::$app->session->getFlash('warning');?></div><div class="text" data-notify-html="text"></div></div></div></div>
</div></div>
<?php endif?>

<?php if(Yii::$app->session->hasFlash('error')) : ?>
<div class="notifyjs-corner" style="top: 0px; right: 0px;"><div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style=""></div>
  <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-error"><div class="image" data-notify-html="image"><i class="fa fa-exclamation"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title"><?= Yii::$app->session->getFlash('error');?></div><div class="text" data-notify-html="text"></div></div></div></div>
</div></div>
<?php endif?>

<?php if(Yii::$app->session->hasFlash('black')) : ?>
<div class="notifyjs-corner" style="top: 0px; right: 0px;"><div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style=""></div>
  <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-black"><div class="image" data-notify-html="image"><i class="fa fa-adjust"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title"><?= Yii::$app->session->getFlash('black');?></div><div class="text" data-notify-html="text"></div></div></div></div>
</div></div><?php endif?>

<?php if(Yii::$app->session->hasFlash('white')) : ?>
<div class="notifyjs-corner" style="top: 0px; right: 0px;"><div class="notifyjs-wrapper">
  <div class="notifyjs-arrow" style=""></div>
  <div class="notifyjs-container" style=""><div class="notifyjs-metro-base notifyjs-metro-white"><div class="image" data-notify-html="image"><i class="fa fa-adjust"></i></div><div class="text-wrapper"><div class="title" data-notify-html="title"><?= Yii::$app->session->getFlash('white');?></div><div class="text" data-notify-html="text"></div></div></div></div>
</div></div><?php endif?>

