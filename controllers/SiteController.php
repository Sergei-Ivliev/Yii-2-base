<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\captcha\CaptchaAction;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
            'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /**   Send Email */
        Yii::$app->mailer->compose()
            ->setFrom(['littlebear1@yandex.ru' => 'Письмо с сайта'])
            ->setTo('littlebear@bk.ru')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->setHtmlBody('<b>Это тестовое письмо для проверки работы почтового сервиса</b>')
            ->send();

        return $this->render('index');
    }

    /**
     * Страница с формой входа на сайт
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Страница с формой регистрации
     *
     * @return Response|string
     * @throws \yii\base\Exception
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTestPage()
    {
        return $this->render('test');
    }


}
