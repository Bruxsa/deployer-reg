<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "release".
 *
 * @property integer $release_id
 * @property integer $project_id
 * @property string $date_time
 * @property integer $release_type
 * @property string $log
 *
 * @property Project $project
 */
class Release extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'release';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['release_id'], 'required'],
            [['release_id', 'project_id', 'release_type'], 'integer'],
            [['date_time'], 'safe'],
            [['log'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'release_id' => 'Release ID',
            'project_id' => 'Project ID',
            'date_time' => 'Date Time',
            'release_type' => 'Release Type',
            'log' => 'Log',
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
