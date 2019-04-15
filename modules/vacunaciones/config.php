<?php
return [
    'layout' => '@app/modules/vacunaciones/views/layouts/menu',
    'components' => [
        'db_ev25' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=192.168.2.24;dbname=db_salud',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
	   ]
    ],
    'params' => [
        // list of parameters
    ],
];
