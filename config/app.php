<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // ...
    ])->toArray(),

    'public-menu' => [
        [
            'id' => "beranda",
            "name" => "Beranda",
            "target" => "/"
        ],
        [
            'id' => "tentang",
            "name" => "Tentang Jalan Cantik",
            "target" => "tentang-jalan-cantik"
        ],
        [
            'id' => "laporan",
            "name" => "Laporan",
            "target" => "",
            "sub-items" => [
                [
                    'id' => "laporan-masuk",
                    "name" => "Masuk",
                    "target" => "",
                ],
                [
                    'id' => "laporan-diterima-ai",
                    "name" => "Diterima AI",
                    "target" => "",
                ],
                [
                    'id' => "laporan-ditolak-ai",
                    "name" => "Ditolak AI",
                    "target" => "",
                ]
            ]
        ],
        [
            'id' => "download",
            "name" => "Download",
            "target" => "download"
        ],
        [
            'id' => "kontak",
            "name" => "Kontak",
            "target" => "kontak"
        ],
        [
            'id' => "privacy",
            "name" => "Privacy - Policy",
            "target" => "privacy-policy"
        ],
    ],

    'dashboard-menu' => [
        [
            'header-name' => '',
            'items' => [
                [
                    'id' => 'dashboard',
                    'name' => 'Dashboard',
                    'target' => 'dashboard',
                    'icon' => 'fa-tachometer-alt',
                ],
                [
                    'id' => 'laporan-masuk',
                    'name' => 'Laporan Masuk',
                    'target' => '',
                    'icon' => 'fa-file',
                    'sub-items' => [
                        [
                            'id' => 'status-jalan',
                            'name' => 'Status Jalan',
                            'target' => 'dashboard/laporan/status-jalan',
                        ],
                        [
                            'id' => 'kasus-jalan',
                            'name' => 'Kasus Jalan',
                            'target' => 'dashboard/laporan/kasus-jalan',
                        ],
                    ],
                ],
                [
                    'id' => 'kelola-ai',
                    'name' => 'Kelola AI',
                    'target' => 'dashboard/kelola-ai',
                    'icon' => 'fa-microchip',
                ],
                [
                    'id' => 'kelola-user',
                    'name' => 'Kelola User',
                    'target' => 'dashboard/kelola-user',
                    'icon' => 'fa-users',
                    'sub-items' => [
                        [
                            'id' => 'daftar-user',
                            'name' => 'Daftar User',
                            'target' => 'dashboard/daftar-user',
                        ],
                        [
                            'id' => 'user-admin',
                            'name' => 'User Admin',
                            'target' => 'dashboard/daftar-user/admin',
                        ],
                        [
                            'id' => 'user-pelapor',
                            'name' => 'User Pelapor',
                            'target' => 'dashboard/daftar-user/pelapor',
                        ],
                        [
                            'id' => 'level-admin',
                            'name' => 'Level Admin',
                            'target' => 'dashboard/daftar-level-admin',
                        ],
                    ]
                ],
                [
                    'id' => 'kelola-peta',
                    'name' => 'Kelola Peta Jalan',
                    'target' => 'dashboard/kelola-peta',
                    'icon' => 'fa-map',
                ],
            ],
        ],
    ]

];
