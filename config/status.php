<?php

return [
    'status_codes' => [
        'success' => '00',
        'unauthorized' => '01',
        'forbidden' => '03',
        'not_found' => '04',
        'unprocessable_entity' => '22',
        'internal_server_error' => '99'
    ],

    'http_codes' => [
        'success' => 200,
        'bad_request' => 400,
        'unauthorized' => 401,
        'forbidden' => 403,
        'not_found' => 404,
        'conflict' => 409,
        'unprocessable_entity' => 422,
        'internal_server_error' => 500,
    ],
];