<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property int|null $city_id
 * @property string|null $avatar
 * @property string $email
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $telegram
 * @property string|null $birthday
 * @property string $password
 * @property string|null $about
 * @property int|null $popularity
 * @property string|null $activity
 * @property int|null $settings
 *
 * @property Favorites[] $favorites
 * @property Favorites[] $favorites0
 * @property Users[] $selectedUsers
 * @property Users[] $users
 * @property Messages[] $messages
 * @property Photos[] $photos
 * @property Responses[] $responses
 * @property Cities $city
 * @property UsersCategories[] $usersCategories
 * @property Categories[] $categories
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['city_id', 'popularity', 'settings'], 'integer'],
            [['birthday', 'activity'], 'safe'],
            [['about'], 'string'],
            [['name', 'avatar', 'email', 'phone', 'skype', 'telegram', 'password'], 'string', 'max' => 50],
            [['password'], 'string', 'min' => 8],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ваше имя',
            'city_id' => 'Город проживания',
            'avatar' => 'Avatar',
            'email' => 'Электронная почта',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'birthday' => 'Birthday',
            'password' => 'Пароль',
            'about' => 'About',
            'popularity' => 'Popularity',
            'activity' => 'Activity',
            'settings' => 'Settings',
        ];
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery|FavoritesQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites0]].
     *
     * @return \yii\db\ActiveQuery|FavoritesQuery
     */
    public function getFavorites0()
    {
        return $this->hasMany(Favorites::className(), ['selected_user_id' => 'id']);
    }

    /**
     * Gets query for [[SelectedUsers]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getSelectedUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'selected_user_id'])->viaTable('favorites', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'user_id'])->viaTable('favorites', ['selected_user_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery|MessagesQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Photos]].
     *
     * @return \yii\db\ActiveQuery|PhotosQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TasksQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['executor_id' => 'id']);
    }


    public function getTasksCount()
    {
        return $this->hasMany(Tasks::className(), ['customer_id' => 'id'])->count();
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|CommentsQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['task_id' => 'id'])->via('tasks');
    }

    /**
     * Gets score.
     *
     * @return float
     */
    public function getScore()
    {
        return count($this->comments) ? array_reduce($this->comments, fn ($sum, $it) => $sum + $it->score, 0) / count($this->comments) : 0;
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery|ResponsesQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CitiesQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[UsersCategories]].
     *
     * @return \yii\db\ActiveQuery|UsersCategoriesQuery
     */
    public function getUsersCategories()
    {
        return $this->hasMany(UsersCategories::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|CategoriesQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])->viaTable('users_categories', ['user_id' => 'id']);
    }

    public function getAge()
    {
        return (new \DateTime())->diff(new \DateTime($this->birthday))->y;
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
