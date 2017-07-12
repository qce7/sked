<?php
/**
 * Created by PhpStorm.
 * User: danielqi
 * Date: 7/12/17
 * Time: 8:12 AM
 */

namespace common\models;


class PeriodBusiness extends Period
{
    public function start(Task $task)
    {
        $this->task_id = $task->id;
        $this->start_at = time();
        $this->end_at = 0;
        $this->task->status = Task::STATUS_ON;
        $this->task->mustSave();
        $this->mustSave();
    }

    public function end()
    {
        $this->end_at = time();
        $this->mustSave();
        $this->task->status = Task::STATUS_OFF;
        $this->task->refreshPeriod();
        $this->task->mustSave();
    }
}