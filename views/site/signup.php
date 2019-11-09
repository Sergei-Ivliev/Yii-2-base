<?php

/**
 * *@var $this yii\web\View
 * @var $form yii\bootstrap\ActiveForm
 * @var $model app\models\forms\LoginForm
 * @var $model app\models\forms\SignupForm
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\forms\LoginForm;

$this->title = 'Register New User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->textInput() ?>
    <?= $form->field($model, 'reenter_password')->textInput() ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
