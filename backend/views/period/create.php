<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Period */

$this->title = Yii::t('common', 'Create Period');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Periods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
