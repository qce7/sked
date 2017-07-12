<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\Group;
use yii\bootstrap\Html;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $taskProvider \yii\data\ActiveDataProvider */
/* @var $searchModel common\models\TaskSearch */

$this->title = 'Sked - A smart&sample schedule tool.';
?>
<div class="site-index">
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $taskProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'group_id',
                'value' => 'group.name',
                'filter' => Group::getList(),
            ],
            'name',
            'budget_period',
            'actual_period',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'start' => function ($url, Task $model, $key) {
                        return $model->canStart() ? Html::a('<span class="glyphicon glyphicon-play"></span>', $url) : '';
                    },
                    'pause' => function ($url, Task $model, $key) {
                        return $model->canPause() ? Html::a('<span class="glyphicon glyphicon-pause"></span>', $url) : '';
                    }
                ],
                'template' => '{start} {pause}',
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
