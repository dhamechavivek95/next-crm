<?php

namespace app\controllers;

use Yii;
use app\models\PaymentDetails;
use app\models\PaymentDetailsSearch;
use app\models\BillMaster;
use app\models\UserChequeDetail;
use app\models\NetBankingDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentMadeController implements the CRUD actions for PaymentDetails model.
 */
class PaymentMadeController extends Controller
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
     * Lists all PaymentDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentDetailsSearch();
        $dataProvider = $searchModel->searchVendor(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Creates a new PaymentDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * PaymentDetails
         * @var PaymentDetails
         */
        $model = new PaymentDetails();

        $requestData = Yii::$app->request->post();

        $transaction = Yii::$app->db->beginTransaction();
        try{
            if($requestData){
                $paymentDetails = $requestData['PaymentDetails'];
                $model->load($requestData);
                $paymentDone = '';

                if(isset($requestData['bill-payment']) && !empty($requestData['bill-payment'])){
                    $billPayments = $requestData['bill-payment'];
                    $bill_id = $requestData['bill_id'];

                    foreach ($bill_id as $key => $value) {
                        $billMaster = BillMaster::find()->where(['vendor_id' => $model->user_id,'bill_id' => $value])->one();
                        if($billMaster instanceof BillMaster){
                            $comma = ($key != 0) ? ',' : '';
                            $paymentDone .= $comma. $value.'-'.$billPayments[$key];
                            $billMaster->due_amount = $billMaster->due_amount - $billPayments[$key];
                            if(!$billMaster->save(false)){
                                $transaction->rollback();
                                Yii::$app->session->setFlash('error','Unable to update Bill Amount.');
                                return $this->redirect(['index']);
                            }
                        }
                    }
                    $model->payment_done = $paymentDone;
                }else{
                    Yii::$app->session->setFlash('warning','No Bills found.');
                    return $this->redirect(['index']);
                }

                $model->user_type = 'VENDOR';
                $model->updated_at = $model->created_at;
                if($model->save()){
                    if($model->payment_type == 'CHEQUE'){
                        $chequeDetails = new UserChequeDetail();
                        $chequeDetails->payment_id = $model->id;
                        $chequeDetails->cheque_no = $model->cheque_no;
                        $chequeDetails->cheque_due = $model->cheque_due;
                        $chequeDetails->cheque_type = $model->cheque_type;
                        if(!$chequeDetails->save(false)){
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Unable to save cheque details.');
                            return $this->refresh();
                        }
                    }
                    if($model->payment_type == 'NET BANKING'){
                        $netBankDetails = new NetBankingDetails();
                        $netBankDetails->payment_id = $model->id;
                        $netBankDetails->transection_id = $model->transaction_id;
                        $netBankDetails->ntb_username = $model->net_username;
                        $netBankDetails->ntb_mo_no = $model->net_mob_no;
                        if(!$netBankDetails->save(false)){
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Unable to save Net Banking details.');
                            return $this->refresh();
                        }
                    }
                    $transaction->commit();
                    Yii::$app->session->setFlash('success','Created successfully.');
                    return $this->redirect(['index']);
                }
                $transaction->rollback();
            }
        }catch(yii\db\Exception $exception){
            $transaction->rollback();
            pd($exception);
            Yii::$app->session->setFlash('error','Unable to save details.');
            return $this->redirect(['index']);
        }


        return $this->render('create', [
            'model' => $model,
            ]);
    }

    /**
     * Updates an existing PaymentDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   /* public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->payment_type == 'CHEQUE'){
            $cheque = UserChequeDetail::findOne(['payment_id' => $id]);
            if($cheque instanceof UserChequeDetail){
                $model->cheque_no = $cheque->cheque_no;
                $model->cheque_due = $cheque->cheque_due;
                $model->cheque_type = $cheque->cheque_type;
            }
        }
        if($model->payment_type == 'NET BANKING'){
            $netBankDetails = NetBankingDetails::findOne(['payment_id' => $id]);
            if($netBankDetails instanceof NetBankingDetails){
                $model->transaction_id = $netBankDetails->transection_id;
                $model->net_username = $netBankDetails->ntb_username;
                $model->net_mob_no = $netBankDetails->ntb_mo_no;
            }
        }

        $requestData = Yii::$app->request->post();

        $transaction = Yii::$app->db->beginTransaction();
        if($requestData){
            $paymentDetails = $requestData['PaymentDetails'];
            $model->load($requestData);

            if(isset($requestData['bill-payment']) && !empty($requestData['bill-payment'])){
                $billPayments = $requestData['bill-payment'];
                $bill_id = $requestData['bill_id'];
            
                foreach ($bill_id as $key => $value) {
                    $billMaster = BillMaster::find()->where(['vendor_id' => $model->user_id,'bill_id' => $value])->one();
                    if($billMaster instanceof BillMaster){
                        $billMaster->due_amount = $billMaster->amount - $billPayments[$key];
                        if(!$billMaster->save(false)){
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Unable to update Bill Amount.');
                            return $this->redirect(['index']);
                        }
                    }
                }

            }else{
                Yii::$app->session->setFlash('warning','No Bills found.');
                return $this->redirect(['index']);
            }

            $model->user_type = 'VENDOR';
            $model->updated_at = $model->created_at;
            if($model->save()){
                if($model->payment_type == 'CHEQUE'){
                    $chequeDetails = new UserChequeDetail();
                    $chequeDetails->payment_id = $model->id;
                    $chequeDetails->cheque_no = $model->cheque_no;
                    $chequeDetails->cheque_due = $model->cheque_due;
                    $chequeDetails->cheque_type = $model->cheque_type;
                    if(!$chequeDetails->save(false)){
                        Yii::$app->session->setFlash('error','Unable to save cheque details.');
                        return $this->refresh();
                    }
                }
                if($model->payment_type == 'NET BANKING'){
                    $netBankDetails = new NetBankingDetails();
                    $netBankDetails->payment_id = $model->id;
                    $netBankDetails->transection_id = $model->transaction_id;
                    $netBankDetails->ntb_username = $model->net_username;
                    $netBankDetails->ntb_mo_no = $model->net_mob_no;
                    if($netBankDetails->save(false)){
                        Yii::$app->session->setFlash('error','Unable to save Net Banking details.');
                        return $this->refresh();
                    }
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success','Updated successfully.');
                return $this->redirect(['index']);
            }
            $transaction->rollback();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing PaymentDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentDetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionFetchBills()
    {
        $userId = Yii::$app->request->post('user_id');
        $billDetails = BillMaster::find()->where(['vendor_id' => $userId])->andWhere(['<>','due_amount',0])->orderBy(['bill_id' => SORT_ASC])->asArray()->all();
        return json_encode($billDetails);
    }
}
