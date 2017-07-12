<?php
/**
 * Created by PhpStorm.
 * User: danielqi
 * Date: 7/11/17
 * Time: 9:05 AM
 */

namespace common\models;


class TaskBusiness extends Task
{
    public function refreshPeriod()
    {
        $total = array_reduce($this->periods, function ($carry, Period $period) {
            $carry += $period->getValue();
            return $carry;
        }, 0);
        $this->actual_period = $total;
    }
}