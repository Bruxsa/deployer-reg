<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "database".
 *
 * @property integer $database_id
 * @property string $name
 * @property string $password_database
 * @property integer $project_id
 *
 * @property Project $project
 */
class Database extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'database';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['database_id'], 'required'],
            [['database_id', 'project_id'], 'integer'],
            [['name', 'password_database'], 'string', 'max' => 45],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'database_id' => 'Database ID',
            'name' => 'Name',
            'password_database' => 'Password Database',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }
}
