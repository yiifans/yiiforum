<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components' => [
	    'user' => [
		    'identityClass' => 'common\models\User',
		    'enableAutoLogin' => true,
	    ],
	    'authManager' => [
	    	'class' => 'base\AuthManager',
	    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
