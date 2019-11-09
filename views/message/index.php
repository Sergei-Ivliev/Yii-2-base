<?php

use app\models\UserMessage;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var UserMessage $model
 */
?>
    <h1>Новое сообщение</h1>


<?php $form = ActiveForm::begin([
    'action' => '/message/submit',
]) ?>

    <h3>Заполните форму</h3>

<?= $form->field($model, 'email')->textInput()->hint('Подсказка') ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'content')->textarea() ?>

<?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>