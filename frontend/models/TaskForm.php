<?php


namespace frontend\models;

use yii\base\Model;
use frontend\models\Tasks;

class TaskForm extends Model
{
    public $categories;
    public $withoutResponse;
    public $remote;
    public $period;
    public $searchText;

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'withoutResponse' => 'Без откликов',
            'remote' => 'Удаленная работа',
            'period' => 'Период',
            'searchText' => 'Поиск по названию',
        ];
    }

    public function rules()
    {
        return [
//            ['categories', 'in', 'range' => [1, 2, 3], 'allowArray' => true],

            [['categories', 'withoutResponse', 'remote', 'period', 'searchText'], 'safe'],
            ['searchText', 'trim'],
            ['searchText', 'string', 'length' => [4, 24]],
            [['withoutResponse', 'remote'], 'boolean'],
            [['period'], 'in', 'range' => ['day', 'week', 'month']],

        ];
    }

    public function getPeriodLabels() {
        return [
            'day' => 'День',
            'week' => 'Неделя',
            'month' => 'Месяц',
        ];
    }

    public function getCategories() {
        return array_column(Categories::find()->all(), 'title', 'id');
    }
    public function getTasks() {
        $tasks = Tasks::find()->where(['tasks.status_id' => '1'])->joinWith(['customer', 'category', 'city']);
        if ($this->remote) {
            $tasks->andWhere('address is null');
        }

        if ($this->withoutResponse) {
            $tasks->joinWith('responses r')
                ->andWhere('r.task_id is null');
        }

        if ($this->period) {
            $date = (new \DateTime())->sub(\DateInterval::createFromDateString($this->getInterval($this->period)))
                ->format('Y-m-d H:m');
            $tasks->andWhere( ['>=', 'created', $date]);
        }

        $tasks->andFilterWhere(['like', 'tasks.title', $this->searchText])
            ->andFilterWhere(['in', 'tasks.category_id', $this->categories]);

        return $tasks->all();
    }

    private function getInterval(string $period):string // не придумал как передать интервал параметром в SQL
    {
        switch ($period) {
            case 'day':
                return '1 day';
            case 'week':
                return '1 week';
            case 'month':
                return '1 month';
        }
    }
}
