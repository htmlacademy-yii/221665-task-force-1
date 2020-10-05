<?php
/* @var $this yii\web\View */
/* @var $users array */
/* @var $sort string */
/* @var $model frontend\models\UserForm */

use TaskForce\Helper\Stars;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Task Force';
?>
<section class="user__search">
    <div class="user__search-link">
        <p>Сортировать по:</p>
        <ul class="user__search-list">
            <li class="user__search-item <?= $sort == 'score' ? 'user__search-item--current' : '' ?>">
                <a href="score" class="link-regular">Рейтингу</a>
            </li>
            <li class="user__search-item <?= $sort == 'tasks' ? 'user__search-item--current' : '' ?>">
                <a href="tasks" class="link-regular">Числу заказов</a>
            </li>
            <li class="user__search-item <?= $sort == 'popularity' ? 'user__search-item--current' : '' ?>">
                <a href="popularity" class="link-regular">Популярности</a>
            </li>
        </ul>
    </div>
    <?php foreach ($users as $user): ?>
    <div class="content-view__feedback-card user__search-wrapper">
        <div class="feedback-card__top">
            <div class="user__search-icon">
                <a href="#"><img src="./img/<?= $user->avatar ?>" width="65" height="65"></a>
                <span><?= msgfmt_format_message(
                        'ru_RU',
                        '{0, plural, =0{нет заданий}one{# задание}few{# задания}many{# заданий}other{всего #}}',
                        [count($user->tasks)]
                    ) ?></span>
                <span><?= msgfmt_format_message(
                        'ru_RU',
                        '{0, plural, =0{нет откликов}one{# отклик}few{# отклика}many{# откликов}other{всего #}}',
                        [count($user->responses)]
                    ) ?></span>
            </div>
            <div class="feedback-card__top--name user__search-card">
                <p class="link-name"><a href="<?= BaseUrl::to(['users/view', 'id' => $user->id]) ?>" class="link-regular"><?= Html::encode($user->name) ?></a></p>
                <?= Stars::render($user->score)?>
                <b>
                <?= $user->score ?>
                </b>
                <p class="user__search-content">
                    <?= strip_tags($user->about) ?>
                </p>
            </div>
            <span class="new-task__time">Был на сайте <?= Yii::$app->formatter->asRelativeTime($user->activity); ?></span>
        </div>
        <div class="link-specialization user__search-link--bottom">
            <?php foreach ($user->categories as $category): ?>
            <a href="#" class="link-regular"><?= $category->title?></a>
            <?php endforeach;?>
        </div>
    </div>
    <?php endforeach;?>
</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'filter-form',
            'options' => ['class' => 'search-task__form'],
            'method' => 'post',
        ]); ?>
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <?= $form->field($model, 'categories')->label(false)->checkboxList($model->getCategories()) ?>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
                <?= $form->field($model, 'isFree')->checkbox()?>
                <?= $form->field($model, 'online')->checkbox()?>
                <?= $form->field($model, 'hasFeedback')->checkbox()?>
                <?= $form->field($model, 'isFavorite')->checkbox()?>
            </fieldset>
            <label class="search-task__name" for="110">Поиск по имени</label>
            <?= $form->field($model, 'searchName')->label(false)->textInput( ['class' => 'input-middle input', 'type' => 'search']) ?>
            <button class="button" type="submit">Искать</button>
        <?php ActiveForm::end(); ?>
    </div>
</section>
