<?php

/* @var $this yii\web\View */
/* @var $cities array */

/* @var $model frontend\models\Users */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<section class="registration__user">
    <h1>Регистрация аккаунта</h1>
    <div class="registration-wrapper">
        <?php
        $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'class' => 'registration__user-form form-create',
            ],
        ]); ?>
        <?= $form->field($model, 'email', [
            'inputOptions' => ['class' => 'input textarea'],
        ])->hint('Введите валидный адрес электронной почты', ['tag' => 'span']) ?>
        <?= $form->field($model, 'name', [
            'inputOptions' => ['class' => 'input textarea'],
        ])->hint('Введите ваше имя и фамилию', ['tag' => 'span']) ?>

        <?= $form->field($model, 'city_id', ['options' => ['tag' => false]])->dropdownList(
            ArrayHelper::map($cities, 'id', 'title'),
            ['class' => 'multiple-select input town-select registration-town']
        )->hint('Укажите город, чтобы находить подходящие задачи', ['tag' => 'span']) ?>

        <?= $form->field($model, 'password', ['options' => ['tag' => false]])->passwordInput(
                ['class' => 'input textarea']
        )->hint('Длина пароля от 8 символов', ['tag' => 'span']) ?>
        <?= Html::submitButton('Создать аккаунт', ['class' => 'button button__registration']) ?>
        <?php ActiveForm::end(); ?>
    </div>

</section>
