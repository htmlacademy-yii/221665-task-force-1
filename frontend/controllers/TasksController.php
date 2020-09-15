<?php

namespace frontend\controllers;

use frontend\models\Tasks;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $tasks = Tasks::find()->where(['status_id' => '1'])->joinWith(['customer', 'category', 'city'])->all();
        return $this->render('index', ['tasks' => $tasks]);
    }

    public function actionShow($id)
    {

        return $this->render('index', ['tasks' => []]);
    }

}
