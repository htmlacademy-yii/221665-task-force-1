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


}
