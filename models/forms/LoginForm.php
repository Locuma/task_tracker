<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public string $login = '';
    public string $password = '';
    public bool $remember_me = true;
    private mixed $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'isExist'],
            ['remember_me', 'boolean'],
        ];
    }

    public function login(): bool
    {
        if ($this->validate()) {

            return Yii::$app->user->login($this->getUser(), $this->remember_me ? 3600*24*30 : 0);
        }
        return false;
    }

    public function getUser(): ?User
    {
        if ($this->_user === false) {
            $this->_user = User::findByLogin($this->login);
        }

        return $this->_user;
    }

    public function isExist(): void
    {
        if (!User::findByLogin($this->login)) {
            $this->addError('login', 'No user with this login');
        }
    }
}
