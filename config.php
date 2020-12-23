<?php

include __DIR__.'/vendor/autoload.php';

$config = [
    'callback' => 'http://sisbb.brazilsouth.cloudapp.azure.com/inicio.php',
    'keys'     => [
                    'id' => '895552023784-qon8skp6p3e55u1du93o4qlneid9i5dk.apps.googleusercontent.com',
                    'secret' => '-kOUXG16fWgsn0VG2Yet2WNZ'
                ],
    'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];

$adapter = new Hybridauth\Provider\Google( $config );
