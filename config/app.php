<?php
return [

    'debug' => false,

    'App' => [
        'namespace' => 'App',
        'encoding' => 'UTF-8',
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        // 'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],

    'Security' => [
        'salt' => 'c3be3e15298b90c20d96554f8385487acd379f4eb9e9cb354f03b1918d726eb4',
    ],

    'Asset' => [
        // 'timestamp' => true,
    ],

    /**
     * Configure the cache adapters.
     */
    'Cache' => [
        'default' => [
            'className' => 'File',
            'path' => CACHE,
        ],
        '_cake_core_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+2 minutes',
        ],

        '_cake_model_' => [
            'className' => 'File',
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+2 minutes',
        ],
    ],
    'Error' => [
        'errorLevel' => E_ALL & ~E_DEPRECATED,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => [],
        'log' => true,
        'trace' => true,
    ],

    'EmailTransport' => [
        'default' => [
            'className' => 'Mail',
            // The following keys are used in SMTP transports
            'host' => 'localhost',
            'port' => 25,
            'timeout' => 30,
            'username' => 'user',
            'password' => 'secret',
            'client' => null,
            'tls' => null,
        ],
    ],

    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
    ],
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Sqlserver',
            'persistent' => false,
            'host' => '192.168.45.185',
            'username' => 'sa',
            'password' => 'Cmch8080',
            'database' => 'Reportes_SAP',
            'encoding' => 'utf8',
            'timezone' => '+00:00',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
        ],
        'tcsBD' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'App\Database\Driver\Sqlserver',
            'persistent' => false,
            'host' => '192.168.45.185',
            'username' => 'sa',
            'password' => 'Cmch8080',
            'database' => 'Reportes_SAP',
            'prefix' => '',
			'init' => ['SET LANGUAGE us_english'],
    ],
],
    /**
     * Configures logging options
     */
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
    ],

    
    'Session' => [
        'defaults' => 'php',
        'timeout' => '120',
    ],
    
        // Version
    'rmp_version' => '2,3,1',
    // ID Auxiliar Camanchaca Pesca Sur
    'camanchaca_id' => '95',
    // Clave de Administrador
    'admin_pass' => 'Bucanero',
    // Directorio para subir archivos
    'file_upload_folder' => 'D:\\rmp_uploads\\',
];
