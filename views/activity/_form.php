<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\Activity
 * @var $form ActiveForm
 */

?>
<div class="activity-form">
    <?php $form = ActiveForm::begin(['action' => ['/activity/update']]); ?>

    <?= $form->field($model, 'title')->textInput(['autofocus' => 'true']) ?>
    <?= $form->field($model, 'date_start')->textInput(['type' => 'date']) ?>
    <?= $form->field($model, 'date_end')->textInput(['type' => 'date']) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'repeat')->checkbox() ?>
    <?= $form->field($model, 'blocked')->checkbox() ?>

    <div class="form-group" style="margin-top: 40px;">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>