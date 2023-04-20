<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class SignUpForm extends Model
{
    public string $login = '';
    public string $first_name = '';
    public string $second_name = '';
    public string $surname = '';

    public string $password = '';

    public bool $remember_me = true;

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
            VarDumper::dump($this->_user); exit;
        }

        return $this->_user;
    }

    public function isExist(): void
    {
        $user = User::findByLogin($this->login);
        if ($user){
            $this->addError('login', 'User with same login exists.');
        }
    }

}