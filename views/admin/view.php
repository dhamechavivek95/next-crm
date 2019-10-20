<?php

use backend\models\Timezone;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin'), 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="bg-picture" style="background-image:url('images/bg_6.jpg')">
            <span class="bg-picture-overlay"></span><!-- overlay -->
            <!-- meta -->
            <div class="box-layout meta bottom">
                <div class="col-sm-6 clearfix">
                    <span class="img-wrapper pull-left m-r-15"><img src="img/avatar-2.jpg" alt="" style="width:64px"
                                                                    class="br-radius"></span>
                    <div class="media-body">
                        <h3 class="text-white mb-2 m-t-10 ellipsis"><?= $model->first_name ?></h3>
                        <h5 class="text-white"> <?= $model->last_name ?></h5>
                    </div>
                </div>
            </div>
            <!--/ meta -->
        </div>
    </div>
</div>

<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-default p-0">
            <div class="panel-body p-0">
                <ul class="nav nav-tabs profile-tabs">
                    <li class="active"><a href="#">About Me</a></li>
                    <li><a href="<?= Url::to(['admin/change-password'])?>">Change Password</a></li>
                </ul>

                <div class="tab-content m-0">

                    <div id="aboutme" class="tab-pane active">
                        <div class="profile-desk">
                            <h1><?= Yii::$app->user->identity->username ?></h1>
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <th colspan="3"><h3>Profile Information</h3></th>
                                </tr>
                                </thead>
                                <?php $form = ActiveForm::begin([
                                    'options' => [
                                        'class' => 'form-horizontal',
                                        'id' => 'profile-form',
                                        'role' => 'form'                                        
                                    ]
                                ]); ?>
                                <tbody>
                                <tr>
                                    <td><b>First Name</b></td>
                                    <td>
                                        <?= $form->field($model, 'first_name',
                                            ['options' => ['class' => 'col-xs-12 col-md-6']])->textInput([
                                            'class' => 'form-control',
                                            'maxlength' => true
                                        ])->label(false) ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Last Name</b></td>
                                    <td>
                                        <?= $form->field($model, 'last_name',
                                            ['options' => ['class' => 'col-xs-12 col-md-6']])->textInput([
                                            'class' => 'form-control',
                                            'maxlength' => true
                                        ])->label(false) ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Email Id</b></td>
                                    <td>
                                        <?= $form->field($model, 'email',
                                            ['options' => ['class' => 'col-xs-12 col-md-6']])->textInput([
                                            'class' => 'form-control',
                                            'maxlength' => true,
                                            'readonly' => true
                                        ])->label(false) ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Contact Number</b></td>
                                    <td>
                                        <?= $form->field($model, 'contact_number',
                                            ['options' => ['class' => 'col-xs-12 col-md-6']])->textInput([
                                            'class' => 'form-control',
                                            'maxlength' => true
                                        ])->label(false) ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Username</b></td>
                                    <td>
                                        <?= $form->field($model, 'username',
                                            ['options' => ['class' => 'col-xs-12 col-md-6']])->textInput([
                                            'class' => 'form-control',
                                            'maxlength' => true,
                                            'readonly' => true,
                                        ])->label(false) ?>

                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <?= Html::submitButton(Yii::t('app', 'Update'),
                                            ['class' => 'btn btn-success']) ?>
                                    </td>
                                </tr>
                                </tbody>
                                <?php ActiveForm::end(); ?>
                            </table>
                        </div> <!-- end profile-desk -->
                    </div> <!-- about-me -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
