<?php

namespace frontend\controllers;

use common\models\TaskSearch;
use Yii;

class TaskController extends \yii\web\Controller
{
    /**
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $taskProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'taskProvider' => $taskProvider,
            'searchModel' => $searchModel,
        ]);
    }
}
