<?php


namespace app\models\forms;


use app\models\User;
use http\Exception;
use Yii;
use yii\base\Model;

/**
 *
 * //* @property string $username
 * @property string $password
 *
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $reenter_password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'reenter_password'], 'required'],
            [['username', 'password', 'reenter_password'], 'string'],
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['password'], 'string', 'min' => 3, 'max' => 30],
            ['reenter_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'reenter_password' => 'Повторите пароль',
        ];
    }

    /**
     * Попытка регистрации пользователя
     * @return bool
     * @throws Exception
     */
    public function register()
    {
        // если валидация прошла успешно
        if ($this->validate()) {
            $user = new User([
                'username' => $this->username,
                'access_token' => "{$this->username}-token",
            ]);

            $user->generateAuthKey();
            $user->password = $this->password;

            if (\Yii::$app->user->can('admin') && $user->save()) {

                Yii::$app->session->setFlash('success', "Пользователь " . $this->username ." добавлен");

            } elseif ($user->save()) {
                return \Yii::$app->user->login($user);
            }
        }

        // вернем false, если не прошла валидация
        return false;
    }


}
