  <?php

  use yii\helpers\Html;
  use yii\helpers\ArrayHelper;
  use app\models\Category;
  use yii\widgets\ActiveForm;

  /* @var $this yii\web\View */
  /* @var $model app\models\Items */
  /* @var $form yii\widgets\ActiveForm */
  ?>

  <div class="items-form">

      <?php $form = ActiveForm::begin(); ?>
      <div class="panel">
          <div class="panel-heading"><?= $this->title ?></div>
          <div class="item-form col-sm-offset-1">

            <div class="row">
                <div class="form-group input-sm">
                      <?= $form->field($model, 'item_name',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
                      <?= $form->field($model, 'item_unit',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
                      <?= $form->field($model, 'item_desc',['options' => ['class' => 'col-sm-3']])->textarea(['maxlength' => true,'class' => 'input-sm form-control']) ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group input-sm">

                <?= $form->field($model, 'cat_id',['options' => ['class' => 'col-sm-3']])->dropdownList(ArrayHelper::map(Category::find()->all(),'cat_id','cat_name'),['maxlength' => true,'class' => 'input-sm form-control','prompt' => 'Select']) ?>

                </div>
              </div>
              <hr>

  <div class="panel-heading">Sales Information</div>
  <div class="row">
      <div class="form-group input-sm">
        <?= $form->field($model, 'sales_rate',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
        <?= $form->field($model, 'sales_account',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
        <?= $form->field($model, 'sales_desc',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
    </div>
  </div>

  <div class="panel-heading">Purchase Information</div>
  <div class="row">
      <div class="form-group input-sm">
  <?= $form->field($model, 'purchase_rate',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
  <?= $form->field($model, 'purchase_account',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
  <?= $form->field($model, 'purchase_desc',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>
  </div>
  </div>
  <hr>
  <div class="row">
      <div class="form-group input-sm">
      <?= $form->field($model, 'is_trackable')->checkbox() ?>

      <?= $form->field($model, 'opening_stock',['options' => ['class' => 'col-sm-3']])->textInput() ?>

      <?= $form->field($model, 'opening_stock_rate',['options' => ['class' => 'col-sm-3']])->textInput() ?>

      <?= $form->field($model, 'stock_account',['options' => ['class' => 'col-sm-3']])->textInput() ?>
    </div>
    </div>
    <div class="break-rule"></div>
    <div class="row">
     <div class="col-sm-offset-5">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>

            <?= Html::a('Cancel','index', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
    </div></div>

      <?php ActiveForm::end(); ?>

  </div>
