<?php

include __DIR__.'/vendor/autoload.php';

$config = [
    'callback' => 'http://localhost/sisbb/sisbbAluno/cadastrarUser.php',
    'keys'     => [
                    'id' => '895552023784-c5c521bf7ufl5i5cqg21cplgu2jcapmh.apps.googleusercontent.com',
                    'secret' => 'jV1dipSvocMKvOXbPCTDkFAz'
                ],
    'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];

$adapter = new Hybridauth\Provider\Google( $config );
