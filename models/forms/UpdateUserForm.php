<?php
namespace app\models\forms;

use app\models\User;
use yii\base\Model;

class UpdateUserForm extends Model
{
    public $username;
    public $password;
    public $reenter_password;

    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['username', 'password', 'reenter_password'], 'string'],
            [['password'], 'string', 'min' => 3, 'max' => 30],
            [['reenter_password'], 'compare', 'compareAttribute' => 'password', 'when' => function (UpdateUserForm $form) {
                return !empty($form->password);
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Новый пароль',
            'reenter_password' => 'Повторите пароль',
        ];
    }

    public function update(User $user)
    {
        if (!$this->validate()) {
            return false;
        }

        $user->username = $this->username;

        if (!empty($this->password)) {
            $user->password = $this->password;
        }

        return $user->save();
    }

}