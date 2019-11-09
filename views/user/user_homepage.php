<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\widgets\DetailView;

/**
 * @var \yii\web\View $this
 * @var \app\models\forms\UpdateUserForm $model
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = Html::encode(Yii::$app->user->identity->username);
?>

        <h1>Страница пользователя &nbsp; <?= Html::encode(Yii::$app->user->identity->username) ?></h1>

        <div class="form-group pull-right">
            <div class="row-lg-offset-1 flex-lg-row">
                <?= Html::a('Список событий', ['activity/index'], ['class' => 'btn btn-success ']) ?>
                <?= Html::a('Мой календарь', ['/calendar'], ['class' => 'btn btn-success ']) ?>
            </div>
<!--            <br>-->
        </div>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'reenter_password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

