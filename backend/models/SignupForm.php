<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.12.2017
 * Time: 23:33
 */
namespace backend\models;
use yii\base\Model;
use yii;

class SignupForm extends Model
{

    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['email','username', 'password'], 'required', 'message' => 'Заполните поле'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Emal'
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if($user->save())
            return $user;
        else
            return $user->getErrors();
    }


}