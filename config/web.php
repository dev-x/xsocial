<?php

$params = require(__DIR__ . '/params.php');
if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    $db = require(__DIR__ . '/db-dev.php');
} else
    $db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'uk-UA',
    'bootstrap' => ['log'],
    'components' => [
        'view' => [
			'theme' => [
				'pathMap' => ['@app/views' => '@app/themes/stargazers'],
				'baseUrl' => '@web/themes/stargazers',
			],
		], 
      'i18n' => [
        'translations' => [
          'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/messages',
            //'sourceLanguage' => 'en-US',
            'fileMap' => [
              'app' => 'app.php',
            //  'app/error' => 'error.php',
            ],
          ],
        ],
      ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        //    'enableStrictParsing' => true,
            'rules' => [
                '' => 'site/index',
                'about' => 'site/about',
                'posts'=>'post/index',
                'admin'=>'admin/index',
                'post/<id:\d+>'=>'post/show',
				[
					'pattern' => 'feed',
					'route' => 'search/taxonomy',
					'defaults' => ['taxonomy' => 'feed'],
				],
                'search'=>'search/index',
                'search/<taxonomy:\w+>'=>'search/taxonomy',
                'search/<taxonomy:\w+>/<keyword:\w+>'=>'search/taxonomy',
                'users'=>'user/index',
                'users/<username:\w+>'=>'user/show',
                'users/<username:\w+>/posts'=>'post/index',
                'users/<username:\w+>/<action:\w+>'=>'user/<action>',
                'users/<username:\w+>/messages/<request:\w+>'=>'messages/index',

            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'NR3rGVfobtCLnetLhjKRMSnBiFDuZNgm',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
