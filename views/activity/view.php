<?php

/**
 * @var $this yii\web\View
 * @var $model \app\models\Activity
 */

use yii\helpers\Html;
use app\models\Activity;
use yii\widgets\DetailView;


?>
<div class="row">
    <h1>Просмотр события</h1>

    <div class="form-group pull-right">
        <?= Html::a('К списку', ['activity/index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Изменить', ['activity/update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            // activity.id - пример перезаписи названия столбца
            'label' => 'Порядковый номер',
            'attribute' => 'id',
        ],
        [
            // activity.id - пример перезаписи значения
            'label' => 'Порядковый номер',
            'value' => function (Activity $model) {
                return "# {$model->id}";
            },
        ],
        //'id',
        'title',
        'date_start:datetime',
        'date_end:date',

        [
            'label' => 'Имя создателя',
            'attribute' => 'user.username', // авто-подключение зависимостей
            // $model->user->username
        ],
        'description',
        'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
        'blocked:boolean',
        'created_at:date',
        'updated_at:date',
    ],

]); ?>

