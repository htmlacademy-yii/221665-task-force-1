<?php

namespace frontend\controllers;

use frontend\models\Tasks;
use Yii;
use frontend\models\TaskForm;
use yii\web\NotFoundHttpException;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $form = new TaskForm();
        $form->load(Yii::$app->request->post());
        $tasks = $form->getTasks();

        return $this->render('index', ['tasks' => $tasks, 'model' => $form]);
    }

    public function actionView($id)
    {
        $task = Tasks::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задание с ID {$id} не существует!");
        }

        return $this->render('show', ['task' => $task]);
    }

}
