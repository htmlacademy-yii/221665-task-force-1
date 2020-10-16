<?php

namespace frontend\controllers;

use frontend\models\Users;
use Yii;
use frontend\models\Cities;

class SignupController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Users();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->goHome();
        }
        $cities = Cities::find()->all();
        return $this->render('index', ['model' => $model, 'cities' => $cities]);
    }
}
