<?php

namespace app\models;

use app\models\forms\SignUpForm;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use \yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @property int $id
     * @property int $id_role
     * @property string $login
     * @property string $password
     * @property string $first_name
     * @property string $second_name
     * @property string $surname
     * @property string $auth_key
     */

    const ROLE_ADMIN = 2;

    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function getRole(): ActiveQuery
    {
        return $this->hasOne(Role::class, ['id' => 'id_role']);
    }

    public function getTaskBoardResponsible(): ActiveQuery
    {
        return $this->hasMany(TaskBoard::class, ['responsible' => 'id']);
    }

    public function getTaskBoardSupervisor(): ActiveQuery
    {
        return $this->hasMany(TaskBoard::class, ['supervisor' => 'id']);
    }

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
