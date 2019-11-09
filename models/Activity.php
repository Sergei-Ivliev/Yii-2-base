<?php

namespace app\models;

use app\components\CachedRecordBehavior;
use yii\base\Exception;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use function Sodium\compare;

/**
 * Модель - Событие
 * @package app\models
 * @property int $id
 * @property string $date_start
 * @property string $date_end
 * @property string $title [varchar(255)]
 * @property int $user_id [int(11)]
 * @property string $description
 * @property bool $repeat [tinyint(1)]
 * @property bool $blocked [tinyint(1)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property-read User $user
 */
class Activity extends ActiveRecord
{

    public function behaviors()
    {
        return [

            TimestampBehavior::class,

//            [
//                'class' => CachedRecordBehavior::class,
//                'prefix' => 'activity',
//            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id', // created_by
                'updatedByAttribute' => 'user_id', // updated_by
            ],
        ];
    }


    public function validDates()
    {
        if (strtotime($this->date_end) < strtotime($this->date_start)) {
            return $this->date_end = $this->date_start;
//            $this->addError('date_end', 'Please give correct  date_end date');
        }

        return $this->date_end;
    }

    /**
     * Правила валидации данных модели
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'date_start', 'description'], 'required'],
            [['title'], 'string', 'min' => 3, 'max' => 30],
            [['title', 'description'], 'string'],
            ['date_end', 'default', 'value' => function () {
                return $this->date_start;
            }],
            ['date_end', 'validDates'],
            [['date_start', 'date_end'], 'date', 'format' => \Yii::$app->params['dateFormat']],
            [['repeat', 'blocked'], 'boolean'],
            [['user_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Наименование',
            'user_id' => 'Пользователь',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'description' => 'Описание',
            'repeat' => 'Повторение',
            'blocked' => 'Блокирование',
        ];
    }

    public function getUser() // $model->user
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Преобразование в массив для календаря
     * @return array
     */
    public function toEvent()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->date_start,
            'end' => $this->date_end,
            'url' => Url::to(['/activity/view', 'id' => $this->id]),
        ];
    }

}

