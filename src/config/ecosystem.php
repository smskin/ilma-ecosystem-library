<?php

return [
    'url'=>[
        'auth'=>env('SERVICE_URL_AUTH',''),
        'admin'=>env('SERVICE_URL_ADMIN',''),
        'site'=>env('SERVICE_URL_SITE',''),
        'api'=>env('SERVICE_URL_API',''),
        'ca'=>env('SERVICE_URL_CA',''),
        'doc'=>env('SERVICE_URL_DOC',''),
        'ipoteka'=>env('SERVICE_URL_IPOTEKA',''),
        'chat'=>env('SERVICE_URL_CHAT',''),
    ],
    'service_token'=>env('SERVICE_TOKEN')
];
