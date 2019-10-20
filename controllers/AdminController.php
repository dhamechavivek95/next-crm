<?php

namespace app\controllers;

use Yii;
use app\models\Admin;
// use app\models\AdminSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\Customer;
use app\models\Vendor;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['dashboard', 'profile', 'update', 'change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionDashboard()
    {

        /*$customerCount = (new Query())->select('cu_id')->from(Customer::tableName())->count();
        $vendorCount = (new Query())->select('vu_id')->from(Vendor::tableName())->count();*/

        return $this->render('dashboard');
    }


    /**
     * Displays a single Admin model.
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Profile Update Successfully.');
            return $this->redirect(['profile']);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Profile Update Successfully.');
            return $this->redirect(['profile']);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Admin model.
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionChangePassword()
    {
        $model = $this->findModel(Yii::$app->user->id);
        $model->setScenario('changePassword');

        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $model->password = md5($model->newPassword);
                $model->save(false);
                Yii::$app->session->setFlash('success', 'Password Change Successfully.');
                return $this->redirect(['change-password']);    
            }
            
        }

        return $this->render('changePassword', [
            'model' => $model,
        ]);
    }
}
