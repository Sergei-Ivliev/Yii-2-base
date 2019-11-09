<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;

class SessionController extends Controller
{
    public function afterAction($action, $result)
    {
        \Yii::$app->session->set('prev_page', Yii::$app->request->url);
        \Yii::$app->session->get('prev_page');
        return parent::afterAction($action, $result);
    }
}