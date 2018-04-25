<?php

namespace app\modules\api\oauth;

use Yii;
use app\models\Users;
use dastanaron\translit\Translit;
use yii\base\Model;
use yii\helpers\Json;
use app\exceptions\ValidationErrorException;

class GoogleOauth extends Model
{
    public $userData;

    public function userOauthRegister() {
         $user = new Users();
         $user->email = $this->userData['emails'][0]['value'];
         $usernameLocal = $this->userData['name']['familyName'] . $this->userData['name']['givenName'];
         $translit = new Translit();
         $user->username = $translit->translit($usernameLocal, true, 'ru-en') . $this->userData['id'];
         $user->password = Yii::$app->security->generateRandomString(10);
         if(!$user->save()) {
             throw new ValidationErrorException('Ошибка валидации: ' . Json::encode($user->errors));
         }else{
             \Yii::$app->response->data = $user;
         };
    }
}