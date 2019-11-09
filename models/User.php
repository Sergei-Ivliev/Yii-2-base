<?php


namespace app\models;


use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property int $created_at
 * @property int $updated_at
 *
 * @property-write $password -> setPassword()
 */

class  User extends ActiveRecord implements IdentityInterface
{

    /**
     * Набор поведений
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * Названия атрибутов модели
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password_hash' => 'Пароль',
            'auth_key' => 'Ключ авторизации',
            'access_token' => 'Токен доступа',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата последнего изменения',
        ];
    }


    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // select * from users where id = $id
        return self::findOne(['id' => $id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\signup\HttpBearerAuth]] will set this parameter to be `yii\filters\signup\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getUserName()
    {
        return $this->username;
    }

    /**
     * Validates the given signup key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given signup key
     * @return bool whether the given signup key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }

    /**
     * Поиск пользователя по логину username
     *
     * @param $username
     *
     * @return User|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        //return $this->password === $password;
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function generateAuthKey()
    {
        try {
            $this->auth_key = \Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
        }
    }

    public function setPassword($password)
    {
        try {
            $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
        }
    }
}