<?php

namespace app\controllers;

use \Yii;
use app\models\LoginForm;
use app\models\Admin;

class AuthController extends \yii\web\Controller
{
    public function actionLogin()
    {

    	$this->layout = '@app/views/noAuthLayout/main';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Admin::updateLastLogin();   
            return $this->redirect(['admin/dashboard']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
