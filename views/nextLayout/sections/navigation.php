<?php
/**
 * Created by PhpStorm.
 * User: akshay
 * Date: 21/09/18
 * Time: 1:20 AM
 */

use yii\helpers\Url;

?>
<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="<?= Url::to([Yii::$app->homeUrl])?>" class="logo-expanded">
            <!-- <img src="img/single-logo.png" alt="logo"> -->
            <span class="nav-label"><?= Yii::t('app', 'Next CRM') ?></span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li><a href="<?= Url::to([Yii::$app->homeUrl]); ?>"><i class="ion-home"></i> <span
                            class="nav-label"><?= Yii::t('app', 'Dashboard') ?></span></a></li>
            <li class="has-submenu"><a href="#"><i class="ion-android-contact"></i> <span class="nav-label"><?= Yii::t('app', 'Contact') ?></span><i class="pull-right ion-ios7-arrow-down"></i></a>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::to(['/vendor']); ?>"><?= Yii::t('app', 'Vendor') ?></a>
                    </li>
                    <li><a href="<?= Url::to(['/customer']); ?>"><?= Yii::t('app', 'Customer') ?></a>
                    </li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="ion-bag"></i> <span class="nav-label"><?= Yii::t('app', 'Inventory') ?></span><i class="pull-right ion-ios7-arrow-down"></i></a>
                <ul class="list-unstyled">
                <li><a href="<?= Url::to(['/category']); ?>"><?= Yii::t('app', 'Category') ?></a>
                    </li>
                    <li><a href="<?= Url::to(['/items']); ?>"><?= Yii::t('app', 'Items') ?></a>
                    </li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="ion-ios7-cart"></i> <span class="nav-label"><?= Yii::t('app', 'Sales') ?></span><i class="pull-right ion-ios7-arrow-down"></i></a>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::to(['/invoice']); ?>"><?= Yii::t('app', 'Invoice') ?></a>
                    </li>
                    <li><a href="<?= Url::to(['/payment-received']); ?>"><?= Yii::t('app', 'Payment Received') ?></a>
                    </li>
                </ul>
            </li>
            <li class="has-submenu"><a href="#"><i class="ion-briefcase"></i> <span class="nav-label"><?= Yii::t('app', 'Purchase') ?></span><i class="pull-right ion-ios7-arrow-down"></i></a>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::to(['/bill']); ?>"><?= Yii::t('app', 'Bill') ?></a>
                    </li>
                    <li><a href="<?= Url::to(['/payment-made']); ?>"><?= Yii::t('app', 'Payment Made') ?></a>
                    </li>
                </ul>
            </li>

            <li><a href="<?= Url::to(['bank-detail/index']); ?>"><i class="ion-plus-circled"></i> <span
                            class="nav-label"><?= Yii::t('app', 'Bank Accounts') ?></span></a></li>

            <li><a href="<?= Url::to(['report/index']); ?>"><i class="ion-clipboard"></i> <span
                            class="nav-label"><?= Yii::t('app', 'Report') ?></span></a></li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
