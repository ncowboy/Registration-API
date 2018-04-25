<?php

return
[
    'class' => 'yii\authclient\Collection',
    'clients' => [
        'google' => [
            'class' => 'yii\authclient\clients\Google',
            'clientId' => '67429662302-ndmefl7mo9qjptn0q6vab8ebprffa3mp.apps.googleusercontent.com',
            'clientSecret' => 'VT_ifuzYV0EXkqFZDL1KXHvj',
        ],
        'facebook' => [
            'class' => 'yii\authclient\clients\Facebook',
            'clientId' => '2085769538371346',
            'clientSecret' => '4aa3c18b912dbab5463ccca6e1f33c79',
        ],
        'vk' => [
            'class' => 'yii\authclient\clients\VKontakte',
            'clientId' => '6419922',
            'clientSecret' => 'pVBuD36BPUTReKjsNlfq',
        ],
    ],
];
