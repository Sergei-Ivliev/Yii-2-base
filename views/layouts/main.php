<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'PrevPage', 'url' => Yii::$app->request->getReferrer()], // простая ссылка на referrer
//            ['label' => 'PrevPage', 'url' =>\Yii::$app->session->get('prev_page'), ''], // через сессию
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Activities', 'url' => ['/activity/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Test page', 'url' => ['/site/test-page']],
            ['label' => 'User Page', 'url' => ['user/user_homepage?id=' . Yii::$app->user->id],
                'visible' => Yii::$app->user->can('user') && Yii::$app->user->isGuest == false,
             'items' => [
                    ['label' => 'Список событий', 'url' => ['/activity/index']],
                    ['label' => 'Мой календарь', 'url' => ['/calendar']],
                    ['label' => 'Страница пользователя', 'url' => ['user/user_homepage?id=' . Yii::$app->user->id]],
                ]],
            ['label' => 'ADMIN', 'url' => ['/'],
                'visible' => Yii::$app->user->can('admin'),
                'items' => [
                    ['label' => 'Users', 'url' => ['user/index']],
                    ['label' => 'Create User', 'url' => ['/user/create']],
                    ['label' => 'Activities', 'url' => ['/activity/index']],
                ]],

            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();

    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
