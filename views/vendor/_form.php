<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $contactDetails app\models\ContactDetails */
/* @var $address app\models\Address */
/* @var $bankDetails app\models\BankDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="vendor-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel">
        <div class="panel-heading"><?= $this->title ?></div>
        <div class="contact-form col-sm-offset-1">

            <div class="row">
                <div class="form-group input-sm">
                    <?= $form->field($model, 'first_name',['options' => ['class' => 'col-sm-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                    <?= $form->field($model, 'last_name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                    <?= $form->field($model, 'company_name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                </div>
            </div>

            <div class="row">
                <div class="form-group input-sm">

                  <?= $form->field($model, 'email',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                     <?= $form->field($model, 'mobile_no',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                     <?= $form->field($model, 'website',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                    </div>
               </div>

           <div class="row">
            <div class="form-group input-sm">
                <?= $form->field($model, 'address',['options' => ['class' => 'col-md-3']])->textarea(['maxlength' => true,'class' => 'input-sm form-control']) ?>
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        <ul class="nav nav-tabs"> 
            <li class="active"> 
                <a href="#careof" data-toggle="tab" aria-expanded="true">
                    <span class="hidden-xs">Care Of Information</span> 
                </a> 
            </li> 
            <li class=""> 
                <a href="#address" data-toggle="tab" aria-expanded="false">
                    <span class="hidden-xs">Billing & Shipping</span> 
                </a> 
            </li> 
        </ul>

    </div>
    <div class="other-detail-form col-sm-offset-1">
        <div class="tab-content"> 
        <div class="tab-pane active" id="careof"> 
            <div class="row">
                <div class="form-group input-sm">

                  <?= $form->field($model, 'contact_person',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                   <?= $form->field($model, 'contact_email',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                   <?= $form->field($model, 'contact_mobile_no',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

               </div>
           </div>

           <div class="row">
                <div class="form-group input-sm">

                  <?= $form->field($model, 'contact_address',['options' => ['class' => 'col-md-3']])->textarea(['maxlength' => true,'class' => 'input-sm form-control']) ?>

               </div>
           </div>
        </div>
                    <div class="tab-pane" id="address"> 
                        <div class="row">
                         <div class="form-group input-sm">
                           <?= $form->field($address, 'billing_attention',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                           <?= $form->field($address, 'shipping_attention',['options' => ['class' => 'col-md-offset-2 col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                       </div>
                   </div>

                   <div class="row">
                     <div class="form-group input-sm">
                       <?= $form->field($address, 'billing_street',['options' => ['class' => 'col-md-4']])->textarea(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                       <?= $form->field($address, 'shipping_street',['options' => ['class' => 'col-md-offset-2 col-md-4']])->textarea(['maxlength' => true,'class' => 'input-sm form-control']) ?>
                   </div>
               </div>

               <div class="row">
                 <div class="form-group input-sm">
                   <?= $form->field($address, 'billing_city',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

                   <?= $form->field($address, 'shipping_city',['options' => ['class' => 'col-md-offset-2 col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

               </div>
           </div>

           <div class="row">
             <div class="form-group input-sm">
               <?= $form->field($address, 'billing_state',['options' => ['class' => 'col-md-4']])->dropDownList(Yii::$app->params['STATES'],['maxlength' => true,'class' => 'input-sm form-control','prompt' => 'Select']) ?>

               <?= $form->field($address, 'shipping_state',['options' => ['class' => 'col-md-offset-2 col-md-4']])->dropDownList(Yii::$app->params['STATES'],['maxlength' => true,'class' => 'input-sm form-control','prompt' => 'Select']) ?>

           </div>
       </div>

       <div class="row">
         <div class="form-group input-sm">
           <?= $form->field($address, 'billing_pincode',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

           <?= $form->field($address, 'shipping_pincode',['options' => ['class' => 'col-md-offset-2 col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

       </div>
   </div>

   <div class="row">
     <div class="form-group input-sm">
       <?= $form->field($address, 'billing_country',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

       <?= $form->field($address, 'shipping_country',['options' => ['class' => 'col-md-offset-2 col-md-4']])->textInput(['maxlength' => true,'class' => 'input-sm form-control']) ?>

   </div>
</div>


</div> 
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