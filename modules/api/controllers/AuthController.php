<?php

namespace app\modules\api\controllers;

use app\modules\api\oauth\GoogleOauth;
use app\modules\api\oauth\FacebookOauth;
use app\modules\api\oauth\VkOauth;
use yii\authclient\clients\Facebook;
use yii\authclient\clients\Google;
use yii\authclient\clients\VKontakte;

class AuthController extends \yii\base\Controller
{
    function verbs()
    {
        return [
            'index' => ['POST'],
        ];
    }

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => 'yii\filters\Cors',
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'actionIndex'],
            ],
        ];
    }

    public function actionIndex($client) {
        // get user data from client
        $userAttributes = $client->getUserAttributes();
        if ($client instanceof Google) { $auth = new GoogleOauth(); }
        else if ($client instanceof Facebook){ $auth = new FacebookOauth(); }
        else if ($client instanceof VKontakte){ $auth = new VkOauth(); }
        else return null; //Exception already declared at 'yii\authclient\Collection'
        $auth->userData = $userAttributes;
        $auth->userOauthRegister();
    }
}
