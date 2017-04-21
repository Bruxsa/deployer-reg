<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Project;
use app\models\User;

class RegController extends Controller {
    public function actionIndex() {

        $model = new Project;
        $user = new User;
        $connection = Yii::$app->db;

        if (!empty($_POST['Project']) && !empty($_POST['User'])) {
            $model->attributes = $_POST['Project'];
            $user->attributes = $_POST['User'];
            if ($model->validate() && $user->validate()) {
                $transaction = $connection->beginTransaction();
                try {
                    if (!$user->save()) {
                        throw new Error('Cannot save user');
                    }
                    $model->user_id = $user->user_id;
                    if (!$model->save()) {
                        throw new Error('Cannot save project');
                    }
                    $transaction->commit();
                    return $this->render('success', ['model' => $model, 'user' => $user]);
                } catch (Exception $err) {
                    $transaction->rollback();
                    throw $err;
                }
            }
        }
        return $this->render('form', ['model' => $model, 'user' => $user]);
    }
}
