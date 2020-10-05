<?php

namespace frontend\controllers;

use frontend\models\UserForm;
use frontend\models\Users;
use Yii;
use yii\web\NotFoundHttpException;

class UsersController extends \yii\web\Controller
{
    public function actionIndex($sort = '')
    {
        $form = new UserForm();
        $form->load(Yii::$app->request->post());
        $users = $form->getUsers($sort);
        return $this->render('index', ['users' => $users, 'model' => $form, 'sort' => $sort]);
    }

    public function actionView($id)
    {
        $user = Users::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("Пользователь с id {$id} не найден");
        }

        return $this->render('show', ['user' => $user]);
    }
}
