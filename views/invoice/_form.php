<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Contact;
use app\models\Items;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin([
        'id' => 'invoice-active-form'
        ]); ?>

        <div class="panel">
            <div class="panel-heading"><?= $this->title ?></div>

            <div class="row">
                <div class="form-group input-sm">

                    <?= $form->field($model, 'customer_id',['options' => ['class' => ['col-sm-3 input-sm']]])->dropDownList(ArrayHelper::map(Contact::find()->where(['contact_type' => 'CUSTOMER'])->all(),'contact_id','display_name'),['prompt' => 'Select','class' => 'select2'])->label('Customer') ?>

                    <?= $form->field($model, 'invoice_number',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['class' => 'form-control']) ?>

                    <?= $form->field($model, 'due_date',['options' => ['class' => ['col-sm-3 input-sm']]])->textInput(['class' => 'form-control start-date']) ?>

                    <div class="col-sm-1 mt-3">
                        <a id="addItem" href="javascript:void(0);"
                           class="btn btn-primary btn-sm mb-2">Add Item
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="pl-3">Date</th>
                                <th class="pl-3">Items</th>
                                <th class="pl-3">Description</th>
                                <th class="pl-1">Size(In Inches)</th>
                                <th>Quantity</th>
                                <th>Total Sq. Feet</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                    </table><br>
                </div>
                <div id="item-errors" hidden="true"><?= json_encode($itemError) ?></div>
                <div id="extra-item-errors" hidden="true"><?= json_encode($extraError) ?></div>
            <div id="append-items">
            <?php
            $totalItemAmount = 0;
            if (!empty($itemsData)) {
                foreach ($itemsData as $key => $item) {
                    $totalItemAmount += $item['total_price'] ? $item['total_price'] : 0;
                    ?>
                <div class="each-item">
            <div class="row">
                <div class="date cust-col-md-2"> 
                  <div class="date-error">
                        <?= Html::textInput('date[]', $item['date'],
                            ['class' => 'input-sm form-control start-date', 'placeholder' => 'Date']); ?>
                    </div>
                </div>
                <div class="items cust-col-md-2"> 
                  <div class="items-error">
                        <?= Html::dropDownList('items[]', $item['items'],ArrayHelper::map(Items::find()->all(),'item_id','item_name'),
                            ['class' => 'input-sm form-control fetch-items','prompt' => 'Select']); ?>
                    </div>
                </div>
                <div class="description cust-col-md-2"> 
                  <div class="description-error">
                        <?= Html::textarea('description[]', $item['description'],
                            ['class' => 'input-sm form-control description_in','placeholder' => 'Description']); ?>
                    </div>
                </div>
                <div class="size cust-col-md-12"> 
                  <div class="length-error">
                        <?= Html::textInput('length[]', $item['length'],
                            ['class' => 'input-sm form-control length_in', 'placeholder' => 'Length','onkeypress' =>"return isNumberKey(event)"]); ?>
                                
                    </div>
                    </div>
                    <div class="size cust-col-md-12">
                    <div class="width-error">
                        <?= Html::textInput('width[]', $item['width'],
                            ['class' => 'input-sm form-control width_in', 'placeholder' => 'Width','onkeypress' =>"return isNumberKey(event)"]); ?>
                    </div>
                    </div>
                    <div class="quantity cust-col-md-1"> 
                        <div class="quantity-error">
                            <?= Html::textInput('quantity[]', $item['quantity'],
                                ['class' => 'input-sm form-control quantity_in', 'placeholder' => 'Quantity','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="total-size cust-col-md-1"> 
                        <div class="total-size-error">
                            <?= Html::textInput('total_size[]', $item['total_size'],
                                ['class' => 'input-sm form-control total_size_in', 'placeholder' => 'Total Sq. Feet','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="price cust-col-md-1"> 
                        <div class="price-error">
                            <?= Html::textInput('price[]', $item['price'],
                                ['class' => 'input-sm form-control price_in', 'placeholder' => 'Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="total-price cust-col-md-1"> 
                        <div class="total-price-error">
                            <?= Html::textInput('total_price[]', $item['total_price'],
                                ['class' => 'input-sm form-control total_price_in', 'placeholder' => 'Total Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <?php if($key != 0){ ?>
                    <div class="" id="removeItem">
                    <a href="javascript:void(0);"
                       class="fa fa-times removeItemBtn">
                    </a>
                </div>
                <?php }?>
                 </div>

            </div>
            <?php }
            } else { ?>
            <div class="each-item">
            <div class="row">
                <div class="date cust-col-md-2"> 
                  <div class="date-error">
                        <?= Html::textInput('date[]', '',
                            ['class' => 'input-sm form-control start-date', 'placeholder' => 'Date']); ?>
                    </div>
                </div>
                <div class="items cust-col-md-2"> 
                  <div class="items-error">
                        <?= Html::dropDownList('items[]', '',ArrayHelper::map(Items::find()->all(),'item_id','item_name'),
                            ['class' => 'input-sm form-control fetch-items','prompt' => 'Select']); ?>
                    </div>
                </div>
                <div class="description cust-col-md-2"> 
                  <div class="description-error">
                        <?= Html::textarea('description[]', '',
                            ['class' => 'input-sm form-control description_in','placeholder' => 'Description']); ?>
                    </div>
                </div>
                <div class="size cust-col-md-2"> 
                  <div class="length-error cust-col-sm-6">
                        <?= Html::textInput('length[]', '',
                            ['class' => 'input-sm form-control length_in', 'placeholder' => 'Length','onkeypress' =>"return isNumberKey(event)"]); ?>
                                
                    </div>
                    <div class="width-error cust-col-sm-6">
                        <?= Html::textInput('width[]', '',
                            ['class' => 'input-sm form-control width_in', 'placeholder' => 'Width','onkeypress' =>"return isNumberKey(event)"]); ?>
                    </div>
                    </div>
                    <div class="quantity cust-col-md-1"> 
                        <div class="quantity-error">
                            <?= Html::textInput('quantity[]', '',
                                ['class' => 'input-sm form-control quantity_in', 'placeholder' => 'Quantity','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="total-size cust-col-md-1"> 
                        <div class="total-size-error">
                            <?= Html::textInput('total_size[]', '',
                                ['class' => 'input-sm form-control total_size_in', 'placeholder' => 'Total Sq. Feet','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="price cust-col-md-1"> 
                        <div class="price-error">
                            <?= Html::textInput('price[]', '',
                                ['class' => 'input-sm form-control price_in', 'placeholder' => 'Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="total-price cust-col-md-1"> 
                        <div class="total-price-error">
                            <?= Html::textInput('total_price[]', '',
                                ['class' => 'input-sm form-control total_price_in', 'placeholder' => 'Total Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                 </div>
            </div>
            <?php } ?>
        </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <a id="addExtraItem" href="javascript:void(0);"
                   class="btn btn-primary btn-sm mb-2">Add Extra Charges
                </a>
            </div>
            <br>
        <div id="append-extra-items">
        <div class="each-extra-item" hidden="">
            <div class="row">
                <div class="extra_date cust-col-md-2"> 
                  <div class="extra_date-error">
                        <?= Html::textInput('extra_date[]', '',
                            ['class' => 'input-sm form-control start-date', 'placeholder' => 'Date','disabled' => true]); ?>
                    </div>
                </div>
                <div class="extra_mold_image cust-col-md-2"> 
                  <div class="extra_mold_image-error">
                        <?= Html::dropDownList('extra_mold_image[]', '',[],
                            ['class' => 'input-sm form-control extra_mold_image_in','prompt' => 'Select','disabled' => true]); ?>
                    </div>
                </div>
                <div class="extra_description cust-col-md-4"> 
                  <div class="extra_description-error">
                        <?= Html::textarea('extra_description[]', '',
                            ['class' => 'input-sm form-control extra_description_in','placeholder' => 'Description','disabled' => true]); ?>
                    </div>
                </div>
                
                    <div class="extra_quantity cust-col-md-1"> 
                        <div class="extra_quantity-error">
                            <?= Html::textInput('extra_quantity[]', '',
                                ['class' => 'input-sm form-control extra_quantity_in', 'placeholder' => 'Quantity','onkeypress' =>"return isNumberKey(event)",'disabled' => true]); ?>
                        </div>
                    </div>
                    <div class="extra_total_size cust-col-md-1"> 
                  <div class="extra_total_size-error">
                        <?= Html::textInput('extra_total_size[]', '',
                            ['class' => 'input-sm form-control extra_total_size_in', 'placeholder' => 'Total Size','onkeypress' =>"return isNumberKey(event)",'disabled' => true]); ?>
                                
                    </div>
                    </div>
                    <div class="extra_rate cust-col-md-1"> 
                        <div class="extra_rate-error">
                            <?= Html::textInput('extra_rate[]', '',
                                ['class' => 'input-sm form-control extra_rate_in', 'placeholder' => 'Price','onkeypress' =>"return isNumberKey(event)",'disabled' => true]); ?>
                        </div>
                    </div>
                    <div class="extra_total_rate cust-col-md-1"> 
                        <div class="extra_total_rate-error">
                            <?= Html::textInput('extra_total_rate[]', 0.00,
                                ['class' => 'input-sm form-control extra_total_rate_in', 'placeholder' => 'Total Price','onkeypress' =>"return isNumberKey(event)",'disabled' => true]); ?>
                        </div>
                    </div>
                    </div>
                    </div>
        <?php
        $extraTotalAmount = 0;
            if (!empty($extraItemsData)) {
                foreach ($extraItemsData as $eKey => $extraItem) {
                    $extraTotalAmount += $extraItem['extra_total_rate'] ? $extraItem['extra_total_rate'] : 0;
                    ?>
                    <div class="each-extra-item">
            <div class="row">
                <div class="extra_date cust-col-md-2"> 
                  <div class="extra_date-error">
                        <?= Html::textInput('extra_date[]', $extraItem['extra_date'],
                            ['class' => 'input-sm form-control start-date', 'placeholder' => 'Date']); ?>
                    </div>
                </div>
                <div class="extra_mold_image cust-col-md-2"> 
                  <div class="extra_mold_image-error">
                        <?= Html::dropDownList('extra_mold_image[]', $extraItem['extra_mold_image'],[],
                            ['class' => 'input-sm form-control extra_mold_image_in','prompt' => 'Select']); ?>
                    </div>
                </div>
                <div class="extra_description cust-col-md-4"> 
                  <div class="extra_description-error">
                        <?= Html::textarea('extra_description[]', $extraItem['extra_description'],
                            ['class' => 'input-sm form-control extra_description_in','placeholder' => 'Description']); ?>
                    </div>
                </div>
                
                    <div class="extra_quantity cust-col-md-1"> 
                        <div class="extra_quantity-error">
                            <?= Html::textInput('extra_quantity[]', $extraItem['extra_quantity'],
                                ['class' => 'input-sm form-control extra_quantity_in', 'placeholder' => 'Quantity','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="extra_total_size cust-col-md-1"> 
                  <div class="extra_total_size-error">
                        <?= Html::textInput('extra_total_size[]', $extraItem['extra_total_size'],
                            ['class' => 'input-sm form-control extra_total_size_in', 'placeholder' => 'Total Size','onkeypress' =>"return isNumberKey(event)"]); ?>
                                
                    </div>
                    </div>
                    <div class="extra_rate cust-col-md-1"> 
                        <div class="extra_rate-error">
                            <?= Html::textInput('extra_rate[]', $extraItem['extra_rate'],
                                ['class' => 'input-sm form-control extra_rate_in', 'placeholder' => 'Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="extra_total_rate cust-col-md-1"> 
                        <div class="extra_total_rate-error">
                            <?= Html::textInput('extra_total_rate[]', $extraItem['extra_total_rate'],
                                ['class' => 'input-sm form-control extra_total_rate_in', 'placeholder' => 'Total Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
               

                <div class="" id="removeExtraItem">
                    <a href="javascript:void(0);"
                       class="fa fa-times removeExtraItemBtn">
                    </a>
                </div>
                 </div>

            </div>
        
        <?php } }

            $totalAmount = isset($model->total_amount) ? $model->total_amount : 0;
        ?>
            </div>
            <hr>
            <div class="col-sm-offset-8">
                        <label class="mt-14">Total  Amount : </label>
                        <div class="input-sm col-sm-7 pull-right">
                            <?= Html::hiddenInput('total_item_amount',$totalItemAmount,['class' => 'form-control','id' => 'total-item-amount']);?>
                            <?= Html::hiddenInput('total_extra_item_amount',$extraTotalAmount,['class' => 'form-control','id' => 'total-extra-item-amount']);?>
                            <?= Html::textInput('total_amount',$totalAmount,['class' => 'form-control','id' => 'total-amount']);?>
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
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<div class="hidden-items">
        <div class="each-item">
            <div class="row">
                <div class="date cust-col-md-2"> 
                  <div class="date-error">
                        <?= Html::textInput('date[]', '',
                            ['class' => 'input-sm form-control start-date', 'placeholder' => 'Date']); ?>
                    </div>
                </div>
                <div class="items cust-col-md-2"> 
                  <div class="items-error">
                        <?= Html::dropDownList('items[]', '',ArrayHelper::map(Items::find()->all(),'item_id','item_name'),
                            ['class' => 'input-sm form-control fetch-items','prompt' => 'Select']); ?>
                    </div>
                </div>
                <div class="description cust-col-md-2"> 
                  <div class="description-error">
                        <?= Html::textarea('description[]', '',
                            ['class' => 'input-sm form-control description_in','placeholder' => 'Description']); ?>
                    </div>
                </div>
                <div class="size cust-col-md-2"> 
                  <div class="length-error cust-col-sm-6">
                        <?= Html::textInput('length[]', '',
                            ['class' => 'input-sm form-control length_in', 'placeholder' => 'Length','onkeypress' =>"return isNumberKey(event)"]); ?>
                                
                    </div>
                    <div class="width-error cust-col-sm-6">
                        <?= Html::textInput('width[]', '',
                            ['class' => 'input-sm form-control width_in', 'placeholder' => 'Width','onkeypress' =>"return isNumberKey(event)"]); ?>
                    </div>
                    </div>
                    <div class="quantity cust-col-md-1"> 
                        <div class="quantity-error">
                            <?= Html::textInput('quantity[]', '',
                                ['class' => 'input-sm form-control quantity_in', 'placeholder' => 'Quantity','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="total-size cust-col-md-1"> 
                        <div class="total-size-error">
                            <?= Html::textInput('total_size[]', '',
                                ['class' => 'input-sm form-control total_size_in', 'placeholder' => 'Total Sq. Feet','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="price cust-col-md-1"> 
                        <div class="price-error">
                            <?= Html::textInput('price[]', '',
                                ['class' => 'input-sm form-control price_in', 'placeholder' => 'Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="total-price cust-col-md-1"> 
                        <div class="total-price-error">
                            <?= Html::textInput('total_price[]', '',
                                ['class' => 'input-sm form-control total_price_in', 'placeholder' => 'Total Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
               

                <div class="" id="removeItem">
                    <a href="javascript:void(0);"
                       class="fa fa-times removeItemBtn">
                    </a>
                </div>
                 </div>

            </div>
        </div>
    </div>

    <div class="hidden-extra-items">
        <div class="each-extra-item">
            <div class="row">
                <div class="extra_date cust-col-md-2"> 
                  <div class="extra_date-error">
                        <?= Html::textInput('extra_date[]', '',
                            ['class' => 'input-sm form-control start-date', 'placeholder' => 'Date']); ?>
                    </div>
                </div>
                <div class="extra_mold_image cust-col-md-2"> 
                  <div class="extra_mold_image-error">
                        <?= Html::dropDownList('extra_mold_image[]', '',[],
                            ['class' => 'input-sm form-control extra_mold_image_in','prompt' => 'Select']); ?>
                    </div>
                </div>
                <div class="extra_description cust-col-md-4"> 
                  <div class="extra_description-error">
                        <?= Html::textarea('extra_description[]', '',
                            ['class' => 'input-sm form-control extra_description_in','placeholder' => 'Description']); ?>
                    </div>
                </div>
                
                    <div class="extra_quantity cust-col-md-1"> 
                        <div class="extra_quantity-error">
                            <?= Html::textInput('extra_quantity[]', '',
                                ['class' => 'input-sm form-control extra_quantity_in', 'placeholder' => 'Quantity','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="extra_total_size cust-col-md-1"> 
                  <div class="extra_total_size-error">
                        <?= Html::textInput('extra_total_size[]', '',
                            ['class' => 'input-sm form-control extra_total_size_in', 'placeholder' => 'Total Size','onkeypress' =>"return isNumberKey(event)"]); ?>
                                
                    </div>
                    </div>
                    <div class="extra_rate cust-col-md-1"> 
                        <div class="extra_rate-error">
                            <?= Html::textInput('extra_rate[]', '',
                                ['class' => 'input-sm form-control extra_rate_in', 'placeholder' => 'Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
                    <div class="extra_total_rate cust-col-md-1"> 
                        <div class="extra_total_rate-error">
                            <?= Html::textInput('extra_total_rate[]', '',
                                ['class' => 'input-sm form-control extra_total_rate_in', 'placeholder' => 'Total Price','onkeypress' =>"return isNumberKey(event)"]); ?>
                        </div>
                    </div>
               

                <div class="" id="removeExtraItem">
                    <a href="javascript:void(0);"
                       class="fa fa-times removeExtraItemBtn">
                    </a>
                </div>
                 </div>

            </div>
        </div>
    </div>
<?php
$this->registerJsFile('@web/js/invoice.js', [
    'depends' => [\app\assets\NextAppAsset::className()]
]);
?>