<?php

namespace common\base;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * Created by PhpStorm.
 * User: danielqi
 * Date: 7/10/17
 * Time: 5:47 AM
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * 保存不成功抛出异常
     * @throws Exception
     */
    public function mustSave()
    {
        if ($this->save() === false) {
            $message = $this->className() . ' save failure';
            throw new Exception($message, $this->errors);
        }
    }
}