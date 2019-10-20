<?php

namespace app\controllers;

use Yii;
use app\models\Contact;
use app\models\ContactDetails;
use app\models\BankDetails;
use app\models\Address;
use app\models\VendorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;

/**
 * VendorController implements the CRUD actions for Contact model.
 */
class VendorController extends Controller
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
     * Lists all Contact models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();
        $address = new Address();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $address->load(Yii::$app->request->post());
                $model->display_name = $model->first_name .' '. $model->last_name;
                $model->contact_type = 'VENDOR';
                if($model->save()){
                      $address->contact_id = $model->contact_id;
                      if($address->save()){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success','Vendor created successfully.');
                        return $this->redirect(['index']);
                      }
                }else{

                  $transaction->rollback();
                  return $this->render('create', [
                      'model' => $model,
                      'contactDetails' => $contactDetails,
                      'address' => $address,
                  ]);
                }
            }catch(Exception $exception){
              pd($exception);
                $transaction->rollback();
                Yii::$app->session->setFlash('error','Something wrong, Please try Again !');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'address' => $address,
        ]);
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $address = Address::findOne(['contact_id' => $model->contact_id]);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $address->load(Yii::$app->request->post());
                $model->display_name = $model->first_name .' '. $model->last_name;
                $model->contact_type = 'VENDOR';
                if($model->save()){
                      $address->contact_id = $model->contact_id;
                      if($address->save()){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success','Vendor updated successfully.');
                        return $this->redirect(['index']);
                      }
                }else{

                  $transaction->rollback();
                  return $this->render('create', [
                      'model' => $model,
                      'address' => $address,
                  ]);
                }
            }catch(Exception $exception){
                $transaction->rollback();
                Yii::$app->session->setFlash('error','Something wrong, Please try Again !');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
          'model' => $model,
          'address' => $address,
        ]);
    }

    /**
     * Deletes an existing Contact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($model = $this->findModel($id)){
            Address::deleteAll(['contact_id' => $model->contact_id]);
            if($model->delete()){
              Yii::$app->session->setFlash('success','Vendor deleted successfully.');
              return $this->redirect(['index']);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
