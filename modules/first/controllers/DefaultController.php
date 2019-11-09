<?php

namespace app\modules\first\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `first` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //var_dump($_GET['q']);
        //$_SESSION['q'] = 10;

        //var_dump($_SESSION['q']);
        //var_dump(Yii::$app->session->get('q'));
        //var_dump(Yii::$app->request->get('q'));

        Yii::$app->seo->registerTitle('New value');

        return $this->render('index');
    }
}
