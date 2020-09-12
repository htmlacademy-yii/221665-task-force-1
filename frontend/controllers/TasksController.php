<?php

namespace frontend\controllers;

use frontend\models\Tasks;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
