<?php
/* @var $this yii\web\View */
/* @var $task frontend\models\Tasks */


use yii\helpers\Html;

$this->title = 'Task Force';
?>

<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">
                    <h1><?= Html::encode($task->title) ?></h1>
                    <span>Размещено в категории
                        <a href="#" class="link-regular"><?= $task->category->title ?></a>
                        <?= Yii::$app->formatter->asRelativeTime($task->created) ?>
                    </span>
                </div>
                <b class="new-task__price new-task__price--clean content-view-price"><?= Html::encode($task->budget) ?><b> ₽</b></b>
                <div class="new-task__icon new-task__icon--<?= $task->category->icon ?> content-view-icon"></div>
            </div>
            <div class="content-view__description">
                <h3 class="content-view__h3">Общее описание</h3>
                <p>
                    <?= Html::encode($task->text) ?>
                </p>
            </div>
            <?php if (count($task->files) > 0): ?>
                <div class="content-view__attach">
                    <h3 class="content-view__h3">Вложения</h3>
                    <?php foreach($task->files as $attachment): ?>
                        <a href="#"><?= Html::encode($attachment->name) ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                         alt="<?= Html::encode($task->address) ?>"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town"><?= $task->city->title ?? '' ?></span><br>
                        <span><?= Html::encode($task->address) ?></span>
                        <p><?= 'тут должны быть какие то данные которых нет в форме создания задачи' ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-view__action-buttons">
            <button class=" button button__big-color response-button open-modal"
                    type="button" data-for="response-form">Откликнуться</button>
            <button class="button button__big-color refusal-button open-modal"
                    type="button" data-for="refuse-form">Отказаться</button>
            <button class="button button__big-color request-button open-modal"
                    type="button" data-for="complete-form">Завершить</button>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отклики <span>(<?= count($task->responses) ?>)</span></h2>
        <div class="content-view__feedback-wrapper">
            <?php foreach($task->responses as $response): ?>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="#"><img src="/img/man-glasses.jpg" width="55" height="55"></a>
                        <div class="feedback-card__top--name">
                            <p><a href="#" class="link-regular"><?= Html::encode($response->user->name) ?></a></p>
                            <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                            <b><?= $response->user->getScore() ?></b>
                        </div>
                        <span class="new-task__time"><?= Yii::$app->formatter->asRelativeTime($response->created) ?></span>
                    </div>
                    <div class="feedback-card__content">
                        <p>
                            <?= Html::encode($response->text) ?>
                        </p>
                        <span><?= $response->price ?> ₽</span>
                    </div>
                    <div class="feedback-card__actions">
                        <a class="button__small-color request-button button"
                           type="button">Подтвердить</a>
                        <a class="button__small-color refusal-button button"
                           type="button">Отказать</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <img src="/img/man-brune.jpg" width="62" height="62" alt="Аватар заказчика">
                <div class="profile-mini__name five-stars__rate">
                    <p><?= Html::encode($task->customer->name) ?></p>
                </div>
            </div>
            <p class="info-customer"><span><?= $task->customer->getTasksCount() ?> заданий</span><span class="last-"><?= Yii::$app->formatter->asRelativeTime($task->customer->activity) ?> на сайте</span></p>
            <a href="/users/view/<?= $task->customer_id?>" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
    <div id="chat-container">
        <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
        <chat class="connect-desk__chat"></chat>
    </div>
</section>
