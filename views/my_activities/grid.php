<?php
//
//
///**
// * @var $this yii\web\View
// * @var $provider ActiveDataProvider
// */
//
//use app\models\Activity;
//use yii\data\ActiveDataProvider;
//use yii\grid\ActionColumn;
//use yii\grid\GridView;
//use yii\grid\SerialColumn;
//use yii\helpers\Html;
//$columns = [
//    [
//        'class' => SerialColumn::class,
//        'header' => 'Псевдо-порядковый номер',
//    ],
//
//    [
//        // activity.id - пример перезаписи значения
//        'label' => 'Порядковый номер',
//        'value' => function (Activity $model) {
//            return "# {$model->id}";
//        },
//    ],
//    //'id',
//    'title',
//    'date_start:date',
//    //'user_id',
//    [
//        'label' => 'Имя создателя',
//        'attribute' => 'user_id', // авто-подключение зависимостей
//        'value' => function (Activity $model) {
//            return $model->user->username;
//        }
//        // $model->user->username
//    ],
//    'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
//    'blocked:boolean',
////    ['class' => ActionColumn::class],
//];
//
//if (Yii::$app->user->can('admin')) {
//    $columns[] = [
//        'class' => ActionColumn::class,
//        'header' => 'Операции',
//        'template' => '{view} {update} {delete}',
////        'buttons' => [
////            'edit' => function ($url, $model, $key) {
////                return Html::a('Custom', $url);
////            }
////        ],
//    ];
//} elseif (Yii::$app->user->can('user')) {
//    $columns[] = [
//        'class' => ActionColumn::class,
//        'header' => 'Операции',
//        'template' => '{view} {update}',
//    ];
//}
//
//
//
//GridView::widget(['dataProvider' => $provider, // $provider->getModels() [....]
//    'columns' => $columns,]);