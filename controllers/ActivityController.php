<?php

namespace app\controllers;

use app\models\Activity;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\PageCache;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ActivityController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class, // ACF
                'only' => ['index', 'view', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete',],
                        'roles' => ['@'],
                    ],
                ],
            ],

            [
                'class' => PageCache::class,
                'only' => ['index'],
                'duration' => 3600,
                'variations' => [
                    \Yii::$app->language,
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' =>  ('SELECT COUNT(*) FROM activity'),
                ],
            ],
        ];
    }

    /**
     * Просмотр всех событий
     * @return string
     */
    public function actionIndex()
    {
        // TODO: получение всех событий через pagination (GridView)

        if (Yii::$app->user->can('admin')) {
            $query = Activity::find();
        } else {
            $query = Activity::find()->where(['user_id' => Yii::$app->user->id]);
        }

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'validatePage' => false,
            ],
        ]);

        return $this->render('index', [
            'provider' => $provider,
        ]);




    }

    /**
     * Просмотр выбранного события
     * @param INT $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        // ключ для записи в кеш
        $cacheKey = "activity_{$id}"; // activity_1

        // проверка на наличие в кеше
        if (Yii::$app->cache->exists($cacheKey)) {
            $item = Yii::$app->cache->get($cacheKey);
        } else {
            // получение из бд с сохранением в кеш
            $item = Activity::findOne($id);

            Yii::$app->cache->set($cacheKey, $item);
        }

        // просматривать записи может только создатель или менеджер
        if (Yii::$app->user->can('manager') || $item->user_id == Yii::$app->user->id) {
            return $this->render('view', [
                'model' => $item,
            ]);
        } else {
            throw new NotFoundHttpException();
        }
    }


    /**
     * Создание нового события
     *
     * @param int|null $id
     *
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id = null)
    {
        $item = $id ? Activity::findOne($id) : new Activity([
            'user_id' => Yii::$app->user->id,
        ]);

        // обновлять записи может только создатель или менеджер
        if (Yii::$app->user->can('manager') || $item->user_id == Yii::$app->user->id) {
            if ($item->load(Yii::$app->request->post()) && $item->validate()) {
                if ($item->save()) {
                    return $this->redirect(['activity/view', 'id' => $item->id]);
                }
            }

            return $this->render('update', [
                'model' => $item,
            ]);
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Удаление выбранного события
     *
     * @param int $id
     *
     * @return string
     */
    public function actionDelete(int $id)
    {
        // TODO: удаление записи по $id + flash Alert, или показ ошибки, если нет прав на редактирование

        Activity::deleteAll(['id' => $id]);

        return $this->redirect(['activity/index']);
    }


}