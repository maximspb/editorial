<?php

namespace backend\models;

use yii\base\Model;

/**
 * Модель взята с фронтенд-части. В админке
 * не предусмотрено свободной регистрации
 * Class SignupForm
 * @package backend\models
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $full_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['full_name', 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'full_name' => 'Имя',
            'email' => 'Email',
        ];
    }

    /**
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->full_name = $this->full_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}