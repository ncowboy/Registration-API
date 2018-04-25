<?php

namespace app\modules\api\controllers;

use app\exceptions\ValidationErrorException;
use app\models\Users;
use yii\helpers\Json;

class SignUpController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Users';

    protected function verbs()
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

    public function actions(){
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
    }

    public function actionIndex(){
        $user = new Users();
        $post = \Yii::$app->request->post();
        if (isset($post)){
            $user->attributes = $post;
            if(!$user->save()) {
               throw new ValidationErrorException('Ошибка валидации: ' . Json::encode($user->errors));
            }else{
                \Yii::$app->response->data = $user;
            };
        }
    }
}