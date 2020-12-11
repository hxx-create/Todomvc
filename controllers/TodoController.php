<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Todo;

class TodoController extends Controller
{
    public $modelClass = 'app\models\Todo';
    public $enableCsrfValidation = false;
    public function actionAddtodo()
    {
        $request = Yii::$app->request;
        $content = $request->getBodyParam('content');
        $status = $request->getBodyParam('status');
        $userid = $request->getBodyParam('userid');
        $model = new Todo();
        $model->content = $content;
        $model->status = $status;
        $model->userid = $userid;
        $model->insert();
    }

    public function actionUpdatetodo()
    {
        $request = Yii::$app->request;
        $content = $request->getBodyParam('newContent');
        $status = $request->getBodyParam('newStatus');
        $id = $request->getBodyParam('id');
        $model = Todo::findOne(['_id' => $id]);
        $model->content = $content;
        $model->status = $status;
        $model->save();
    }

    public function actionQuerytodo()
    {
        $request = Yii::$app->request;
        $status = $request->getBodyParam('status');
        $userid = $request->getBodyParam('userid');
        $model = Todo::find(['userid' => $userid]);
        if ($model->status == $status) {
            return $model;
        }
    }

    public function actionFindtodo()
    {
        $request = Yii::$app->request;
        $status = $request->getBodyParam('status');
        $userid = $request->getBodyParam('userid');
        $model = Todo::findAll(['userid' => $userid]);
        return $model;
    }

    public function actionDeletetodo()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = Todo::findAll(['_id' => $id]);
        $model->delete();
    }

    public function actionBatchdeletetodo()
    {
        $request = Yii::$app->request;
        $userid = $request->getBodyParam('userid');
        return $userid;
        $model = Todo::findAll(['userid' => $userid]);
        if ($model->active == "completed") {
            $model->delete();
        }
    }
}
