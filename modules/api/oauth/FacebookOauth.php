<?php

namespace app\modules\api\oauth;

use Yii;
use app\models\Users;
use yii\base\Model;
use yii\helpers\Json;
use app\exceptions\ValidationErrorException;

class FacebookOauth extends Model
{
    public $userData;

    public function userOauthRegister() {
         $user = new Users();
         $user->email = $this->userData['email'];
         $user->username = implode(explode(' ', $this->userData['name'])) . $this->userData['id'];
         $user->password = Yii::$app->security->generateRandomString(10);
         if(!$user->save()) {
             throw new ValidationErrorException('Ошибка валидации: ' . Json::encode($user->errors));
         }else{
             \Yii::$app->response->data = $user;
         };
    }
}