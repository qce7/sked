<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "period".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $start_at
 * @property integer $end_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Task $task
 */
class Period extends \common\base\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'start_at', 'end_at'], 'required'],
            [['task_id', 'start_at', 'end_at', 'created_at', 'updated_at'], 'integer'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'task_id' => Yii::t('common', 'Task ID'),
            'start_at' => Yii::t('common', 'Start At'),
            'end_at' => Yii::t('common', 'End At'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
