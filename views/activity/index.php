<?php

/**
 * @var $this yii\web\View
 * @var $provider ActiveDataProvider
 */

use app\models\Activity;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;

$columns = [
    [
        'class' => SerialColumn::class,
        'header' => 'Псевдо-порядковый номер',
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
    'date_start:date',
    //'user_id',
    [
        'label' => 'Имя создателя',
        'attribute' => 'user_id', // авто-подключение зависимостей
        'value' => function (Activity $model) {
            return $model->user->username;
        }
        // $model->user->username
    ],
    'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
    'blocked:boolean',
    'created_at:date'
//    ['class' => ActionColumn::class],
];

if (Yii::$app->user->can('user')) {
    $columns[] = [
        'class' => ActionColumn::class,
        'header' => 'Операции',
        'template' => '{view} {update} {delete}',
//        'buttons' => [
//            'edit' => function ($url, $model, $key) {
//                return Html::a('Custom', $url);
//            }
//        ],
    ];
}

?>

<div class="row">
    <h1>Список событий</h1>

    <div class="form-group pull-right">

        <?= Html::a('Создать', ['activity/update'], ['class' => 'btn btn-success pull-right']) ?>
        <?php if (!Yii::$app->user->can('admin')) {

            echo Html::a('На страницу пользователя', ['user/user_homepage?id=' . Yii::$app->user->getId()], ['class' => 'btn btn-success']);
        }
        ?>
        &emsp;&emsp;&emsp;
    </div>
</div>


<?= GridView::widget(['dataProvider' => $provider, // $provider->getModels() [....]
    'columns' => $columns,]) ?>

