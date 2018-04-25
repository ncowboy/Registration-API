<?php

namespace app\modules\api;

/**
 * api module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';
    public $defaultRoute = 'user';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
