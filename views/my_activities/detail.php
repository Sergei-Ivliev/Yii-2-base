<?php
//
///**
// * @var $this yii\web\View
// * @var $model \app\models\Activity
// */
//use app\models\Activity;
//use yii\widgets\DetailView;
//
//DetailView::widget([
//    'model' => $model,
//    'attributes' => [
//        [
//            // activity.id - пример перезаписи названия столбца
//            'label' => 'Порядковый номер',
//            'attribute' => 'id',
//        ],
//        [
//            // activity.id - пример перезаписи значения
//            'label' => 'Порядковый номер',
//            'value' => function (Activity $model) {
//                return "# {$model->id}";
//            },
//        ],
//        //'id',
//        'title',
//        'date_start:datetime',
//        'date_end:date',
//
//        [
//            'attribute' => 'date_end',
//            'format' => ['date', 'php:Y'], // форматирование даты
//            //'value' => function (Activity $model) {
//            //    return Yii::$app->formatter->asDate($model->date_end, 'php:Y');
//            //}
//        ],
//        //'user_id',
//        [
//            'label' => 'Имя создателя',
//            'attribute' => 'user.username', // авто-подключение зависимостей
//            // $model->user->username
//        ],
//        'description',
//        'repeat:boolean', // Yii::$app->formatter->asBoolean(...)
//        'blocked:boolean',
//    ],
//]);