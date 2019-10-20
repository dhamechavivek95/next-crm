<?php

namespace app\controllers;

use Yii;
use app\models\Invoice;
use app\models\InvoiceSearch;
use app\models\InvoiceItems;
use app\models\InvoiceExtra;
use app\models\Items;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
        'delete' => ['POST'],
        ],
        ],
        ];
    }

    /**
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }


    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoice();

        $requestData = Yii::$app->request->post();
        $itemsData = [];
        $extraItemsData = [];
        $itemError = [];
        $extraError = [];

        if ($requestData) {
            $transaction = Yii::$app->db->beginTransaction();
            $model->load($requestData);
            if(!$model->invoice_number){                    
                $model->invoice_number = 'INV-'.mt_rand(100000,999999);
            }

            $model->created_date = date('Y-m-d H:i:s');
            $model->updated_date = date('Y-m-d H:i:s');
            $model->total_amount = $requestData['total_amount'];
            $model->due_amount = $requestData['total_amount'];

            if($model->save()){
                InvoiceItems::deleteAll(['inv_id' => $model->inv_id]);
                InvoiceExtra::deleteAll(['inv_id' => $model->inv_id]);
                $items = $this->saveItemsData($model, true);
                $extra = $this->saveExtraItemsData($model, true);
                if ((isset($items['error']) && $items['success'] == false) || (isset($extra['error']) && $extra['success'] == false)) {
                    $itemsData = $this->getItemsPostData();
                    $extraItemsData = $this->getExtraItemsPostData();
                    $itemError = isset($items['error']) ? $items['error'] : [];
                    $extraError = isset($extra['error']) ? $extra['error'] : [];
                    $transaction->rollback();
                    Yii::$app->session->setFlash('error','Please check for Errors.');
                    return $this->render('create', [
                        'model' => $model,
                        'itemsData' => $itemsData,
                        'extraItemsData' => $extraItemsData,
                        'itemError' => $itemError,
                        'extraError' => $extraError,
                        ]);
                }else{
                    $items = $this->saveItemsData($model, false);
                    $extra = $this->saveExtraItemsData($model, false);
                    if ($items['success'] == true || $extra['success'] == true) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Saved Successfully');
                        return $this->redirect(['index']);
                    }else{
                        $itemsData = $this->getItemsPostData();
                        $extraItemsData = $this->getExtraItemsPostData();
                        $itemError = isset($items['error']) ? $items['error'] : [];
                        $extraError = isset($extra['error']) ? $extra['error'] : [];
                        $transaction->rollback();
                        Yii::$app->session->setFlash('error','Please check for Errors.');
                        return $this->render('create', [
                            'model' => $model,
                            'itemsData' => $itemsData,
                            'extraItemsData' => $extraItemsData,
                            'itemError' => $itemError,
                            'extraError' => $extraError,
                            ]);
                    }
                }
            }

            $itemsData = $this->getItemsPostData();
            $extraItemsData = $this->getExtraItemsPostData();
        }

        return $this->render('create', [
            'model' => $model,
            'itemsData' => $itemsData,
            'extraItemsData' => $extraItemsData,
            'itemError' => $itemError,
            'extraError' => $extraError,
            ]);
    }

     /**
     * Save Items Data.
     *
     * @param $model
     * @param $validate
     * @return array
     */
     private function saveItemsData($model, $validate)
     {
        $result = [];
        $date = Yii::$app->request->post('date');
        $items = Yii::$app->request->post('items');
        $description = Yii::$app->request->post('description');
        $length = Yii::$app->request->post('length');
        $width = Yii::$app->request->post('width');
        $quantity = Yii::$app->request->post('quantity');
        $total_size = Yii::$app->request->post('total_size');
        $price = Yii::$app->request->post('price');
        $total_price = Yii::$app->request->post('total_price');
        if (isset($date) && isset($items) && isset($total_price)) {
            for ($i = 0; $i < count($date); $i++) {
                $invoiceItem = new InvoiceItems();
                $invoiceItem->inv_id = $model->inv_id;
                $invoiceItem->item_id = $items[$i];
                $invoiceItem->date = $date[$i];
                $invoiceItem->description = $description[$i];
                $invoiceItem->length = $length[$i];
                $invoiceItem->width = $width[$i];
                $invoiceItem->quantity = $quantity[$i];
                $invoiceItem->quantity_feet = $total_size[$i];
                $invoiceItem->rate = $price[$i];
                $invoiceItem->total_price = $total_price[$i];
                if ($validate) {
                    if (!$invoiceItem->validate()) {
                        $result['error'][$i] = $invoiceItem->errors;
                    }
                } else {
                    if (!$invoiceItem->save()) {
                        $result['error'][$i] = $invoiceItem->errors;
                    }
                }
                unset($invoiceItem);
            }
        }
        $result['success'] = isset($result['error']) ? false : true;
        return $result;
    }

    /**
     * Save Extra Items Data.
     *
     * @param $model
     * @param $validate
     * @return array
     */
    private function saveExtraItemsData($model, $validate)
    {
        $result = [];
        $extraDate = Yii::$app->request->post('extra_date');
        $extraMoldImage = Yii::$app->request->post('extra_mold_image');
        $extrDescription = Yii::$app->request->post('extra_description');
        $extraQuantity = Yii::$app->request->post('extra_quantity');
        $extraTotalSize = Yii::$app->request->post('extra_total_size');
        $extraRate = Yii::$app->request->post('extra_rate');
        $extraTotalRate = Yii::$app->request->post('extra_total_rate');
        if (isset($extraDate) && !empty($extraDate)) {
            for ($i = 0; $i < count($extraDate); $i++) {
                $invoiceExtra = new InvoiceExtra();
                $invoiceExtra->inv_id = $model->inv_id;
                $invoiceExtra->extra_date = $extraDate[$i];
                $invoiceExtra->extra_mold_image = $extraMoldImage[$i];
                $invoiceExtra->extra_description = $extrDescription[$i];
                $invoiceExtra->extra_quantity = $extraQuantity[$i];
                $invoiceExtra->extra_total_size = $extraTotalSize[$i];
                $invoiceExtra->extra_rate = $extraRate[$i];
                $invoiceExtra->extra_total_rate = $extraTotalRate[$i];
                if ($validate) {
                    if (!$invoiceExtra->validate()) {
                        $result['error'][$i] = $invoiceExtra->errors;
                    }
                } else {
                    if (!$invoiceExtra->save()) {
                        $result['error'][$i] = $invoiceExtra->errors;
                    }
                }
                unset($invoiceExtra);
            }
        }
        $result['success'] = isset($result['error']) ? false : true;
        return $result;
    }


    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->inv_id]);
        }

        return $this->render('update', [
            'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function getItemsPostData()
    {
        $date = Yii::$app->request->post('date');
        $items = Yii::$app->request->post('items');
        $description = Yii::$app->request->post('description');
        $length = Yii::$app->request->post('length');
        $width = Yii::$app->request->post('width');
        $quantity = Yii::$app->request->post('quantity');
        $total_size = Yii::$app->request->post('total_size');
        $price = Yii::$app->request->post('price');
        $total_price = Yii::$app->request->post('total_price');
        $count = count($date);
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['date'] = $date[$i];
            $data[$i]['items'] = $items[$i];
            $data[$i]['description'] = $description[$i];
            $data[$i]['length'] = $length[$i];
            $data[$i]['width'] = $width[$i];
            $data[$i]['quantity'] = $quantity[$i];
            $data[$i]['total_size'] = $total_size[$i];
            $data[$i]['price'] = $price[$i];
            $data[$i]['total_price'] = $total_price[$i];
        }
        return $data;
    }

    public function getExtraItemsPostData()
    {
        $data = [];
        $extraDate = Yii::$app->request->post('extra_date');
        $extraMoldImage = Yii::$app->request->post('extra_mold_image');
        $extrDescription = Yii::$app->request->post('extra_description');
        $extraQuantity = Yii::$app->request->post('extra_quantity');
        $extraTotalSize = Yii::$app->request->post('extra_total_size');
        $extraRate = Yii::$app->request->post('extra_rate');
        $extraTotalRate = Yii::$app->request->post('extra_total_rate');
        if(isset($extraDate) && !empty($extraDate)){
            $count = count($extraDate);
            for ($i = 0; $i < $count; $i++) {
                $data[$i]['extra_date'] = $extraDate[$i];
                $data[$i]['extra_mold_image'] = $extraMoldImage[$i];
                $data[$i]['extra_description'] = $extrDescription[$i];
                $data[$i]['extra_quantity'] = $extraQuantity[$i];
                $data[$i]['extra_total_size'] = $extraTotalSize[$i];
                $data[$i]['extra_rate'] = $extraRate[$i];
                $data[$i]['extra_total_rate'] = $extraTotalRate[$i];
            }
        }
        return $data;
    }

    public function actionFetchData($id)
    {
        if($id){
            $items = Items::find()->where(['item_id' => $id])->asArray()->one();
            return json_encode($items);
        }
        return false;
    }
}
