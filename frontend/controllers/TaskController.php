<?php

namespace frontend\controllers;

use common\models\Period;
use common\models\PeriodBusiness;
use common\models\Task;
use common\models\TaskSearch;
use frontend\base\FrontController;
use Yii;
use yii\web\HttpException;

class TaskController extends FrontController
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

    public function actionStart($id)
    {
        $task = Task::findOne($id);
        $model = new PeriodBusiness();
        $model->start($task);
        return $this->redirectRefer();
    }

    public function actionPause($id)
    {
        $period = Period::find()->where(['task_id' => $id, 'end_at' => 0])->one();
        if (is_null($period)) {
            throw new HttpException(404);
        }
        $period->end_at = time();
        $period->mustSave();
        $period->task->status = Task::STATUS_OFF;
        $period->task->refreshPeriod();
        $period->task->mustSave();
        return $this->redirectRefer();
    }
}
