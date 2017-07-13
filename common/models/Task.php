<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property integer $budget_period
 * @property integer $actual_period
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property Period[] $periods
 * @property Group $group
 */
class Task extends \common\base\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    const STATUS_FINISH = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'name', 'budget_period'], 'required'],
            [['group_id', 'budget_period', 'actual_period', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['status', 'actual_period'], 'default', 'value' => 0],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'group_id' => Yii::t('common', 'Group ID'),
            'name' => Yii::t('common', 'Name'),
            'budget_period' => Yii::t('common', 'Budget Period'),
            'actual_period' => Yii::t('common', 'Actual Period'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriods()
    {
        return $this->hasMany(Period::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public static function getList(): array
    {
        $arr = static::find()->select(['id', 'name'])->asArray()->all();
        $res = ArrayHelper::map($arr, 'id', 'name');
        return $res;
    }

    public function canPause(): bool
    {
        return $this->status == static::STATUS_ON;
    }

    public function canStart(): bool
    {
        return $this->status == static::STATUS_OFF;
    }

    public function delete()
    {
        Period::deleteAll(['task_id' => $this->id]);
        return parent::delete();
    }

}
