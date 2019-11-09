<?php

/**
 * @var $this yii\web\View
 * @var $model Activity
 */

use app\models\Activity;
use yii\helpers\Html;


?>
    <div class="row">
        <h1><?= Html::encode($model->title ?: 'Новое событие') ?></h1>


        <div class="form-group pull-right">
            <?= Html::a('Отмена', ['activity/view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        </div>
    </div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>