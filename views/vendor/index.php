<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-index">

<div class="col-sm-6">
    <h2><?= Html::encode($this->title) ?></h2></div>
    <?php Pjax::begin(); ?>
    <div class="col-sm-6 mt-2"><p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success pull-right','data-pjax' => 0]) ?>
    </p></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">


                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'layout' => "{summary}{items}{pager}",
                                'columns' => [

                                [
                                'attribute' => 'display_name',
                                ],
                                [
                                'attribute' => 'company_name',
                                ],
                                [
                                'attribute' => 'email',
                                ],
                                [
                                'attribute' => 'mobile_no',
                                ],
                                [
                                'attribute' => 'total_amount',
                                ],
                                [
                                'attribute' => 'due_amount',
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header'=> 'Action',
                                    'contentOptions'=> ['class' => 'inline-class'],
                                    'template' => '{update}{delete}',
                                    'buttons' => [
                                            'update' => function ($url, $model, $key) {
                                              return Html::a('<span class="fa fa-pencil"></span>',$url,[
                                                'class' => 'btn btn-sm btn-info'
                                                ]);
                                            },
                                          'delete' => function ($url, $model, $key) {
                                             return Html::a('<span class="fa fa-trash"></span>', $url, [
                                                'class' => 'btn btn-sm btn-danger ml-2',
                                                'title' => Yii::t('app', 'Delete'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                                'data-method' => 'post', 'data-pjax' => '0',
                                                ]);
                                            }
                                        ],
                                    ],
                                ],
                             'tableOptions' => [
                             'id' => 'datatable',
                             'class' => 'table table-striped table-bordered',
                             ],
                             ]); ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <?php Pjax::end(); ?>
 </div>