<?php
/* @var $this yii\web\View */
/* @var $tasks array */

/* @var $model frontend\models\TaskForm */

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Task Force';
?>
<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>

        <?php foreach ($tasks as $task): ?>
            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="<?= BaseUrl::to(['tasks/view', 'id' => $task->id]) ?>" class="link-regular"><h2><?= strip_tags($task->title) ?></h2></a>
                    <a class="new-task__type link-regular" href="#"><p><?= $task->category->title ?></p></a>
                </div>
                <div class="new-task__icon new-task__icon--<?= $task->category->icon ?>"></div>
                <p class="new-task_description">
                    <?= strip_tags($task->text) ?>
                </p>
                <b class="new-task__price new-task__price--translation"><?= $task->budget ?><b> ₽</b></b>
                <p class="new-task__place"><?= strip_tags($task->address) ?></p>
                <span class="new-task__time"><?= Yii::$app->formatter->asRelativeTime($task->created); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="new-task__pagination">
        <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
                <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
        </ul>
    </div>
</section>
<section class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'filter-form',
            'options' => ['class' => 'search-task__form'],
            'method' => 'post',
        ]); ?>
        <fieldset class="search-task__categories">
            <?= $form->field($model, 'categories')->checkboxList($model->getCategories()) ?>
        </fieldset>
        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>
            <?= $form->field($model, 'withoutResponse')->checkbox()?>
            <?= $form->field($model, 'remote')->checkbox()?>
        </fieldset>
        <label class="search-task__name" for="8">Период</label>
        <?= $form->field($model, 'period')->dropdownList($model->getPeriodLabels(),
            ['class' => 'input multiple-select']
        ); ?>
        <?= $form->field($model, 'searchText')->textInput( ['class' => 'input-middle input', 'type' => 'search']) ?>
        <button class="button" type="submit">Искать</button>
        <?php ActiveForm::end(); ?>
    </div>
</section>
