<?php

return [
    'url'=>[
        'public'=>[
            'auth'=>env('PUBLIC_SERVICE_URL_AUTH','http://10.0.75.1:81'),
            'admin'=>env('PUBLIC_SERVICE_URL_ADMIN','http://10.0.75.1:82'),
            'site'=>env('PUBLIC_SERVICE_URL_SITE','http://10.0.75.1:83'),
            'api'=>env('PUBLIC_SERVICE_URL_API','http://10.0.75.1:84'),
            'ca'=>env('PUBLIC_SERVICE_URL_CA','http://10.0.75.1:85'),
            'doc'=>env('PUBLIC_SERVICE_URL_DOC','http://10.0.75.1:86')
        ],
        'internal'=>[
            'auth'=>env('INTERNAL_SERVICE_URL_AUTH','http://ilma_auth'),
            'admin'=>env('INTERNAL_SERVICE_URL_ADMIN','http://ilma_admin'),
            'site'=>env('INTERNAL_SERVICE_URL_SITE','http://ilma_site'),
            'api'=>env('INTERNAL_SERVICE_URL_API','http://ilma_api'),
            'ca'=>env('INTERNAL_SERVICE_URL_CA','http://ilma_ca'),
            'doc'=>env('INTERNAL_SERVICE_URL_DOC','http://ilma_doc')
        ],
    ],
    'service_token'=>env('SERVICE_TOKEN')
];
