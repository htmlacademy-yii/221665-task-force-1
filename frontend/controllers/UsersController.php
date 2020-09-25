<?php

namespace frontend\controllers;

use frontend\models\UserForm;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex($sort = '')
    {
        $form = new UserForm();
        $form->load(Yii::$app->request->post());
        $users = $form->getUsers($sort);
        return $this->render('index', ['users' => $users, 'model' => $form, 'sort' => $sort]);
    }
}
