<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace app\components;

use Yii;
use yii\base\Component;

class Seo extends Component
{
    public function registerTitle($value)
    {
        Yii::$app->view->title = $value;
    }
}