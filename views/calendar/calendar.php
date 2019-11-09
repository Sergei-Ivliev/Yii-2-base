<?php

use yii\web\View;

/**
 * @var View $this
 * @var array $events
 */

$this->title = 'Calendar';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Calendar</h1>

<?= edofre\fullcalendar\Fullcalendar::widget([
    'options' => [
        'id' => 'calendar',
        'language' => 'ru',
    ],
    'clientOptions' => [
        'weekNumbers' => true,
        'selectable' => true,
        'defaultView' => 'month',
    ],

    'events' => $events,
]);
?>
