<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TaskForm;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $form = new TaskForm();
        $form->load(Yii::$app->request->post());
        $tasks = $form->getTasks();

        return $this->render('index', ['tasks' => $tasks, 'model' => $form]);
    }


    public function actionFilter()
    {
        $model = new TaskForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

            return $this->render('index', ['tasks' => []]);
        } else {
            $errors = $model->getErrors();
            var_dump($errors);
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('index', ['tasks' => []]);
        }
    }

}
