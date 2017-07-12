<?php

namespace frontend\base;
use yii\web\Controller;
use Yii;

/**
 * Created by PhpStorm.
 * User: danielqi
 * Date: 7/12/17
 * Time: 9:09 AM
 */
class FrontController extends Controller
{
    /**
     * @param array $default
     * @return \yii\web\Response
     */
    public function redirectRefer($default = ['index'])
    {
        $url = Yii::$app->request->referrer;
        $url || $url = $default;
        return $this->redirect($url);
    }
}