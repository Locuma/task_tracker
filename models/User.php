<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @property int $id
     * @property string $login
     * @property string $password
     * @property string $first_name
     * @property string $second_name
     * @property string $surname
     * @property string $auth_key
     */

    public static function findIdentity($id): ?BaseActiveRecord
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public static function findByLogin(string $login): ?static
    {
        return User::findOne(['login' => $login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): ?bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function fillUser(SignUpForm $user) : void
    {
        $this->first_name = $user->first_name;
        $this->second_name = $user->second_name;
        $this->surname = $user->surname;
        $this->login = $user->login;
        $this->password = $user->password;
    }

}
