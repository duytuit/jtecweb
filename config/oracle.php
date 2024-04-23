<?php

return [
    'oracle' => [
        'driver' => 'oracle',
        'tns' => env('ORA_DB_TNS', ''),
        'host' => env('ORA_DB_HOST', ''),
        'port' => env('ORA_DB_PORT', '1521'),
        'database' => env('ORA_DB_DATABASE', ''),
        'service_name' => env('ORA_DB_SERVICE_NAME', ''),
        'username' => env('ORA_DB_USERNAME', ''),
        'password' => env('ORA_DB_PASSWORD', ''),
        'charset' => env('ORA_DB_CHARSET', 'AL32UTF8'),
        'prefix' => env('ORA_DB_PREFIX', ''),
        'prefix_schema' => env('ORA_DB_SCHEMA_PREFIX', ''),
        'edition' => env('ORA_DB_EDITION', 'ora$base'),
        'server_version' => env('ORA_DB_SERVER_VERSION', '11g'),
        'load_balance' => env('ORA_DB_LOAD_BALANCE', 'yes'),
        'max_name_len' => env('ORA_ORA_MAX_NAME_LEN', 30),
        'dynamic' => [],
        'sessionVars' => [
            'NLS_TIME_FORMAT' => 'HH24:MI:SS',
            'NLS_DATE_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
            'NLS_TIMESTAMP_FORMAT' => 'YYYY-MM-DD HH24:MI:SS',
            'NLS_TIMESTAMP_TZ_FORMAT' => 'YYYY-MM-DD HH24:MI:SS TZH:TZM',
            'NLS_NUMERIC_CHARACTERS' => '.,',
        ],
    ],
];
