<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

class SignUpForm extends Model
{
    public ?string $login = null;
    public ?string $first_name = null;
    public ?string $second_name = null;
    public ?string $surname = null;
    public ?string $password = null;

    private mixed $_user = false;

    public function rules(): array
    {
        return [
            [['login', 'password', 'first_name', 'second_name', 'surname'], 'required'],
            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'isExist'],
            ['password', 'filter', 'filter' => 'trim'],
            ['first_name', 'filter', 'filter' => 'trim'],
            ['second_name', 'filter', 'filter' => 'trim'],
            ['surname', 'filter', 'filter' => 'trim'],
            [['login'], 'string', 'max' => 13],
            [['password', 'first_name'], 'string', 'max' => 20],
            [['second_name', 'surname'], 'string', 'max' => 30],
        ];
    }

    public function validatePassword($attribute, $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
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
        $user = User::findByLogin($this->login);
        if ($user) {
            $this->addError('login', 'User with same login exists.');
        }
    }

}