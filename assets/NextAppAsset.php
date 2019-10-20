<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class NextAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/css/bootstrap-reset.css',
        'themes/css/animate.css',
        'themes/assets/font-awesome/css/font-awesome.css',
        'themes/assets/ionicon/css/ionicons.min.css',
        'library/timepicker/bootstrap-datepicker.min.css',
        'themes/assets/select2/select2.css',
        'themes/assets/datatables/jquery.dataTables.min.css',
        'themes/assets/notifications/notification.css',
        'themes/js/bootstrap-editable/css/bootstrap-editable.css',
        'themes/css/style.css',
        'themes/css/helper.css',
        'themes/css/style-responsive.css',
        'themes/css/nextgeneral.css',
    ];
    public $js = [
        'themes/js/jquery-ui-1.10.1.custom.min.js',
        'themes/js/pace.min.js',
        'themes/js/wow.min.js',
        'themes/js/jquery.nicescroll.js',
        'themes/js/jquery.app.js',
        'library/timepicker/bootstrap-datepicker.js',
        'themes/assets/select2/select2.min.js',
        'themes/assets/datatables/jquery.dataTables.min.js',
        'themes/assets/datatables/dataTables.bootstrap.js',
        'themes/assets/notifications/notify.min.js',
        'themes/assets/notifications/notify-metro.js',
        'themes/assets/notifications/notifications.js',
        'themes/js/bootstrap-editable/js/bootstrap-editable.min.js',
        'themes/js/jquery.validate.min.js',
        'themes/js/nextgeneral.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
