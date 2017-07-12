<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\Group;

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
