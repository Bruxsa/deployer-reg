<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $email_user
 * @property string $password_hash
 * @property integer $status_user
 *
 * @property Project[] $projects
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_user'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['user_id', 'status_user'], 'integer'],
            [['email_user'], 'unique', 'message' => 'Пользователь уже существует'],
            [['email_user'], 'email', 'message' => 'Неверный e-mail адрес'],
            [['email_user', 'password_hash'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Номер',
            'email_user' => 'E-mail',
            'password_hash' => 'Пароль',
            'status_user' => 'Status User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['user_id' => 'user_id']);
    }
}
