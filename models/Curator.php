<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curator".
 *
 * @property integer $curator_id
 * @property string $name_curator
 * @property integer $status
 * @property string $email_curator
 *
 * @property Project[] $projects
 */
class Curator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['curator_id'], 'required'],
            [['curator_id', 'status'], 'integer'],
            [['name_curator', 'email_curator'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'curator_id' => 'Curator ID',
            'name_curator' => 'Name Curator',
            'status' => 'Status',
            'email_curator' => 'Email Curator',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['curator_id' => 'curator_id']);
    }
}
