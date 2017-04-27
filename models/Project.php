<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $project_id
 * @property string $name
 * @property string $group
 * @property integer $curator_id
 * @property string $title
 * @property string $description
 * @property string $git
 * @property string $subdomain
 * @property integer $status_project
 * @property string $approve_code
 * @property string $reject_code
 * @property string $date_add
 * @property string $date_check
 * @property integer $files_size
 * @property string $date_size
 * @property integer $use_mysql
 * @property integer $use_composer
 * @property integer $user_npm
 * @property integer $projectcol
 * @property integer $user_id
 *
 * @property Database[] $databases
 * @property Curator $curator
 * @property User $user
 * @property Release[] $releases
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_project'], 'default', 'value' => 1],
            [['use_mysql'], 'default', 'value' => 1],
            [['name', 'group', 'git'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['project_id', 'curator_id', 'status_project', 'files_size', 'use_mysql', 'use_composer', 'user_npm', 'projectcol', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['git'], 'validGit', 'message' => ''],
            [['git'], 'unique', 'message' => 'Этот проект уже выложен'],
            [['date_add', 'date_check', 'date_size'], 'safe'],
            [['name', 'group', 'title', 'git', 'subdomain', 'approve_code', 'reject_code'], 'string', 'max' => 45],
            [['curator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curator::className(), 'targetAttribute' => ['curator_id' => 'curator_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'name' => 'ФИО',
            'group' => 'Номер группы',
            'curator_id' => 'Curator ID',
            'title' => 'Title',
            'description' => 'Description',
            'git' => 'Ссылка на git-репозиторий',
            'subdomain' => 'Subdomain',
            'status_project' => 'Status Progect',
            'approve_code' => 'Approve Code',
            'reject_code' => 'Reject Code',
            'date_add' => 'Date Add',
            'date_check' => 'Date Check',
            'files_size' => 'Files Size',
            'date_size' => 'Date Size',
            'use_mysql' => 'Use Mysql',
            'use_composer' => 'Use Composer',
            'user_npm' => 'User Npm',
            'projectcol' => 'Projectcol',
            'user_id' => 'User ID',
        ];
    }
    
    public function validGit($attribute, $params) 
    {
        $cmd = 'git ls-remote ' . escapeshellarg($this->$attribute);
        exec($cmd, $output, $result);
        if ($result) {
            $this->addError($attribute, 'Неверная ссылка на Git');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatabases()
    {
        return $this->hasMany(Database::className(), ['project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurator()
    {
        return $this->hasOne(Curator::className(), ['curator_id' => 'curator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReleases()
    {
        return $this->hasMany(Release::className(), ['project_id' => 'project_id']);
    }
}
