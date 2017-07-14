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
 * magic property
 * @property string $start_time
 * @property string $end_time
 *
 * @property TaskBusiness $task
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
            [['task_id', 'start_at', 'end_at', 'start_time', 'end_time'], 'required'],
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
        return $this->hasOne(TaskBusiness::className(), ['id' => 'task_id']);
    }

    /**
     * calc period value by start and end
     * @return int
     */
    public function getValue(): int
    {
        if ($this->end_at <= 0) {
            return 0;
        }
        $res = ($this->end_at - $this->start_at) / 3600;
        return max(0, intval($res));
    }

    /**
     * @inheritdoc
     * @return PeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PeriodQuery(get_called_class());
    }

    public function getStart_time()
    {
        return Yii::$app->formatter->asDateTime($this->start_at);
    }

    public function setStart_time($value)
    {
        $this->start_at = strtotime($value);
    }

    public function getEnd_time()
    {
        return Yii::$app->formatter->asDateTime($this->end_at);
    }

    public function setEnd_time($value)
    {
        $this->end_at = strtotime($value);
    }
}
