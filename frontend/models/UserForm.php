<?php


namespace frontend\models;

use frontend\models\Users;

class UserForm extends \yii\base\Model
{

    public $categories;
    public $isFree;
    public $online;
    public $hasFeedback;
    public $isFavorite;
    public $searchName;

    public function rules()
    {
        return [
            [['categories', 'isFree', 'online', 'hasFeedback', 'isFavorite', 'searchName'], 'safe'],
            [['searchName'], 'string', 'length' => [4, 24]],
            [['hasFeedback', 'online', 'isFree', 'isFavorite'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'hasFeedback' => 'Есть отзывы',
            'online' => 'Сейчас онлайн',
            'searchName' => 'Поиск по имени',
            'isFree' => 'Сейчас свободен',
            'isFavorite' => 'В избранном'
        ];
    }

    public function getUsers($sort)
    {
        $users = Users::find()
            ->innerJoinWith('usersCategories uc')
            ->leftJoin('tasks', 'tasks.executor_id = users.id')
            ->leftJoin('comments c', 'tasks.id = c.task_id');

        if ($this->categories) {
            $users->where(['in', 'uc.category_id', $this->categories]);
            // fixme категории применяются независимо
        }

        if ($this->online) {
            $lastVisit = (new \DateTime())->modify('-30m')->format('Y-m-d H:i:s');
            $users->andWhere(['>=', 'activity', $lastVisit]);
        }

        if ($this->isFree) {
            $users->andWhere(['not in', 'tasks.status_id', [1, 3]]);
        }

        if ($this->isFavorite) {
            // todo пока у нас нет авторизации вывожу всех пользователей попавших в Избранное
            $users->innerJoin('favorites f', 'users.id = f.selected_user_id');
        }

        if ($this->hasFeedback) {
            $users->innerJoin('responses r', 'tasks.id = r.task_id');
        }


        $users->andFilterWhere(['like', 'name', $this->searchName]);

        if ($sort == 'popularity') {
            $users->orderBy('users.popularity');
        } elseif ($sort == 'tasks') {
            $users->addGroupBy('name')->orderBy('count(distinct tasks.id)');
        } elseif ($sort == 'score') {
            $users->addGroupBy('name')->orderBy('avg(c.score)');
        }

        return $users->all();
    }

    public function getCategories()
    {
        return array_column(Categories::find()->all(), 'title', 'id');
    }

}
