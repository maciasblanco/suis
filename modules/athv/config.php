<?php
return [
    'layout' => '@app/modules/athv/views/layouts/menu',
    'components' => [
        'db_ev25' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=10.29.2.15;dbname=db_salud',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
	   ]
    ],
    'params' => [
        // list of parameters
    ],
];
