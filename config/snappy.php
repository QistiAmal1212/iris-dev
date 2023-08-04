<?php

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    return [
        'pdf' => [
            'enabled' => true,
            'binary' => base_path('vendor/lifewatch/wkhtmltopdf-windows/bin/wkhtmltopdf64.exe'),
            'timeout' => false,
            'options' => [
                'enable-local-file-access' => true,
            ],
            'env' => [],
        ],
        'image' => [
            'enabled' => true,
            'binary' => base_path('vendor/lifewatch/wkhtmltopdf-windows/bin/wkhtmltopdf64.exe'),
            'timeout' => false,
            'options' => [
                'enable-local-file-access' => true,
            ],
            'env' => [],
        ],
    ];
} else {
    return [
        'pdf' => [
            'enabled' => true,
            'binary' => env('WKHTML_PDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
            'timeout' => false,
            'options' => [
                'enable-local-file-access' => true,
            ],
            'env' => [],
        ],
        'image' => [
            'enabled' => true,
            'binary' => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),
            'timeout' => false,
            'options' => [
                'enable-local-file-access' => true,
            ],
            'env' => [],
        ],
    ];
}
