<?php return array (
  'ajax' => 
  array (
    'messages' => 
    array (
      'success' => 
      array (
        'created' => 'Created successfully',
        'updated' => 'Updated successfully',
        'deleted' => 'Deleted successfully',
        'copied' => 'Copied successfully',
      ),
    ),
    'status' => 
    array (
      'success' => 
      array (
        'created' => 201,
        'updated' => 200,
        'deleted' => 200,
      ),
    ),
  ),
  'app' => 
  array (
    'name' => 'demo22.bivaco.net',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://demo22.bivaco.net',
    'asset_url' => NULL,
    'timezone' => 'Asia/Ho_Chi_Minh',
    'locale' => 'vi',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:nlRNpYIcDxG2fnTnK0d7Mz7hj3MkcrdbqvSQGVfqkjY=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\ViewServiceProvider',
      24 => 'App\\Providers\\AuthServiceProvider',
      25 => 'App\\Providers\\EventServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      28 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Carbon' => 'Illuminate\\Support\\Carbon',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'password_resets',
        'expire' => 15,
        'throttle' => 15,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\laragon\\www\\demo22\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'demo22bivaconet_cache',
  ),
  'cacheKey' => 
  array (
    'setting' => 'setting_cache',
    'category_post_all' => 'category_post_all_cache',
    'category_product_all' => 'category_product_all_cache',
    'category_product_menu' => 'category_product_menu_cache',
    'category_post_menu' => 'category_post_menu_cache',
  ),
  'constants' => 
  array (
    'CATEPRO' => '2',
    'CATEPRO_CHILD1' => '364',
    'CATEPRO_CHILD2' => '299',
    'SETTING_EXPERT' => '361',
    'SETTING_CONTENT' => '357',
    'SETTING_NEWS' => '358',
    'CATEPOST_BOG' => '55',
    'SETTING_CUSTOMER' => '366',
    'CATEPOST_NEWS' => '85',
    'CATEPOST_EVENTS' => '79',
    'CATEPOST_PROJECT' => '88',
    'CATEPOST_POLICY' => '89',
    'SETTING_MAPS' => '328',
    'GALAXY_MOVI' => '22',
    'id_quattranmavang' => '367',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'asiatravel_news',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'asiatravel_news',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'asiatravel_news',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'asiatravel_news',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'demo22bivaconet_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'C:\\laragon\\www\\demo22\\storage\\fonts/',
      'font_cache' => 'C:\\laragon\\www\\demo22\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\admin\\AppData\\Local\\Temp',
      'chroot' => 'C:\\laragon\\www\\demo22',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\laragon\\www\\demo22\\storage\\framework/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'excel_database' => 
  array (
    'categoryProduct' => 
    array (
      'title' => true,
      'model' => '\\App\\Models\\CategoryProduct',
      'excelfile' => 'category_product.xlsx',
      'selectField' => 
      array (
        0 => 'id',
        1 => 'name',
        2 => 'slug',
        3 => 'icon_path',
        4 => 'avatar_path',
        5 => 'active',
        6 => 'parent_id',
        7 => 'admin_id',
        8 => 'created_at',
        9 => 'updated_at',
      ),
      'importField' => 
      array (
        1 => 'name',
        2 => 'slug',
        3 => 'icon_path',
        4 => 'avatar_path',
        5 => 'active',
        6 => 'parent_id',
        7 => 'admin_id',
      ),
      'titleField' => 
      array (
        'id' => 'id',
        'name' => 'name',
        'slug' => 'slug',
        'icon_path' => 'icon_path',
        'avatar_path' => 'avatar_path',
        'active' => 'active',
        'parent_id' => 'parent_id',
        'admin_id' => 'admin_id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
      ),
    ),
    'categoryPost' => 
    array (
      'title' => true,
      'model' => '\\App\\Models\\CategoryPost',
      'excelfile' => 'category_post.xlsx',
      'selectField' => 
      array (
        0 => 'id',
        1 => 'name',
        2 => 'slug',
        3 => 'icon_path',
        4 => 'avatar_path',
        5 => 'active',
        6 => 'parent_id',
        7 => 'admin_id',
        8 => 'created_at',
        9 => 'updated_at',
      ),
      'importField' => 
      array (
        1 => 'name',
        2 => 'slug',
        3 => 'icon_path',
        4 => 'avatar_path',
        5 => 'active',
        6 => 'parent_id',
        7 => 'admin_id',
      ),
      'titleField' => 
      array (
        'id' => 'id',
        'name' => 'name',
        'slug' => 'slug',
        'icon_path' => 'icon_path',
        'avatar_path' => 'avatar_path',
        'active' => 'active',
        'parent_id' => 'parent_id',
        'admin_id' => 'admin_id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
      ),
    ),
    'product' => 
    array (
      'title' => true,
      'model' => '\\App\\Models\\Product',
      'excelfile' => 'product.xlsx',
      'selectField' => 
      array (
        0 => 'id',
        1 => 'name',
        2 => 'slug',
        3 => 'price',
        4 => 'sale',
        5 => 'hot',
        6 => 'pay',
        7 => 'number',
        8 => 'warranty',
        9 => 'view',
        10 => 'description',
        11 => 'avatar_path',
        12 => 'description_seo',
        13 => 'title_seo',
        14 => 'content',
        15 => 'active',
        16 => 'category_id',
        17 => 'suppiler_id',
        18 => 'admin_id',
        19 => 'created_at',
        20 => 'updated_at',
      ),
      'importField' => 
      array (
        1 => 'name',
        2 => 'slug',
        3 => 'price',
        4 => 'sale',
        5 => 'hot',
        6 => 'pay',
        7 => 'number',
        8 => 'warranty',
        9 => 'view',
        10 => 'description',
        11 => 'avatar_path',
        12 => 'description_seo',
        13 => 'title_seo',
        14 => 'content',
        15 => 'active',
        16 => 'category_id',
        17 => 'suppiler_id',
        18 => 'admin_id',
      ),
      'titleField' => 
      array (
        'name' => 'name',
        'slug' => 'slug',
        'price' => 'price',
        'sale' => 'sale',
        'hot' => 'hot',
        'pay' => 'pay',
        'number' => 'number',
        'warranty' => 'warranty',
        'view' => 'view',
        'description' => 'description',
        'avatar_path' => 'avatar_path',
        'description_seo' => 'description_seo',
        'title_seo' => 'title_seo',
        'content' => 'content',
        'active' => 'active',
        'category_id' => 'category_id',
        'suppiler_id' => 'suppiler_id',
        'admin_id' => 'admin_id',
      ),
    ),
    'post' => 
    array (
      'title' => true,
      'model' => '\\App\\Models\\Post',
      'excelfile' => 'post.xlsx',
      'selectField' => 
      array (
        0 => 'id',
        1 => 'name',
        2 => 'slug',
        3 => 'description',
        4 => 'content',
        5 => 'avatar_path',
        6 => 'description_seo',
        7 => 'title_seo',
        8 => 'view',
        9 => 'hot',
        10 => 'active',
        11 => 'category_id',
        12 => 'admin_id',
        13 => 'created_at',
        14 => 'updated_at',
      ),
      'importField' => 
      array (
        1 => 'name',
        2 => 'slug',
        3 => 'description',
        4 => 'content',
        5 => 'avatar_path',
        6 => 'description_seo',
        7 => 'title_seo',
        8 => 'view',
        9 => 'hot',
        10 => 'active',
        11 => 'category_id',
        12 => 'admin_id',
      ),
      'titleField' => 
      array (
        'name' => 'name',
        'slug' => 'slug',
        'description' => 'description',
        'content' => 'content',
        'avatar_path' => 'avatar_path',
        'description_seo' => 'description_seo',
        'title_seo' => 'title_seo',
        'warranty' => 'warranty',
        'view' => 'view',
        'hot' => 'hot',
        'active' => 'active',
        'category_id' => 'category_id',
        'admin_id' => 'admin_id',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\demo22\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\demo22\\public\\storage',
        'url' => 'https://demo22.bivaco.net/storage',
        'visibility' => 'public',
        'throw' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
      ),
    ),
    'links' => 
    array (
      'C:\\laragon\\www\\demo22\\public\\storage' => 'C:\\laragon\\www\\demo22\\storage\\app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'languages' => 
  array (
    'supported' => 
    array (
      'vi' => 
      array (
        'value' => 'vi',
        'name' => 'Việt Nam',
        'image' => '',
      ),
    ),
    'default' => 'vi',
  ),
  'lfm' => 
  array (
    'use_package_routes' => true,
    'allow_private_folder' => true,
    'allow_multi_user' => true,
    'private_folder_name' => 'UniSharp\\LaravelFilemanager\\Handlers\\ConfigHandler',
    'allow_shared_folder' => true,
    'path_absolute' => false,
    'folder_categories' => 
    array (
      'file' => 
      array (
        'folder_name' => 'files',
        'startup_view' => 'list',
        'max_size' => 50000,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
          4 => 'image/webp',
          5 => 'image/svg+xml',
          6 => 'application/pdf',
          7 => 'text/plain',
        ),
      ),
      'image' => 
      array (
        'folder_name' => 'photos',
        'startup_view' => 'grid',
        'max_size' => 50000,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/webp',
          2 => 'image/pjpeg',
          3 => 'image/png',
          4 => 'image/gif',
          5 => 'image/svg+xml',
        ),
      ),
    ),
    'paginator' => 
    array (
      'perPage' => 30,
    ),
    'disk' => 'public',
    'rename_file' => false,
    'rename_duplicates' => false,
    'alphanumeric_filename' => false,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'should_validate_mime' => false,
    'over_write_on_duplicate' => false,
    'should_create_thumbnails' => true,
    'thumb_folder_name' => 'thumbs',
    'raster_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
    ),
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => 
    array (
      'pdf' => 'Adobe Acrobat',
      'doc' => 'Microsoft Word',
      'docx' => 'Microsoft Word',
      'xls' => 'Microsoft Excel',
      'xlsx' => 'Microsoft Excel',
      'zip' => 'Archive',
      'gif' => 'GIF Image',
      'jpg' => 'JPEG Image',
      'jpeg' => 'JPEG Image',
      'png' => 'PNG Image',
      'ppt' => 'Microsoft PowerPoint',
      'pptx' => 'Microsoft PowerPoint',
    ),
    'php_ini_overrides' => 
    array (
      'memory_limit' => '256M',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\laragon\\www\\demo22\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\laragon\\www\\demo22\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'C:\\laragon\\www\\demo22\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'smtp.gmail.com',
        'port' => '587',
        'encryption' => 'tls',
        'username' => 'kietluan.ad@gmail.com',
        'password' => 'zuzrglntcvdihuux',
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
    ),
    'from' => 
    array (
      'address' => 'kietluan.ad@gmail.com',
      'name' => 'demo22.bivaco.net',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\laragon\\www\\demo22\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'permissions' => 
  array (
    'access' => 
    array (
      'category-product-list' => 'category_product_list',
      'category-product-add' => 'category_product_add',
      'category-product-edit' => 'category_product_edit',
      'category-product-delete' => 'category_product_delete',
      'category-post-list' => 'category_post_list',
      'category-post-add' => 'category_post_add',
      'category-post-edit' => 'category_post_edit',
      'category-post-delete' => 'category_post_delete',
      'slider-list' => 'slider_list',
      'slider-add' => 'slider_add',
      'slider-edit' => 'slider_edit',
      'slider-delete' => 'slider_delete',
      'menu-list' => 'menu_list',
      'menu-add' => 'menu_add',
      'menu-edit' => 'menu_edit',
      'menu-delete' => 'menu_delete',
      'product-list' => 'product_list',
      'product-add' => 'product_add',
      'product-edit' => 'product_edit',
      'product-delete' => 'product_delete',
      'post-list' => 'post_list',
      'post-add' => 'post_add',
      'post-edit' => 'post_edit',
      'post-delete' => 'post_delete',
      'setting-list' => 'setting_list',
      'setting-add' => 'setting_add',
      'setting-edit' => 'setting_edit',
      'setting-delete' => 'setting_delete',
      'admin-user-list' => 'admin_user_list',
      'admin-user-add' => 'admin_user_add',
      'admin-user-edit' => 'admin_user_edit',
      'admin-user-delete' => 'admin_user_delete',
      'admin-user_frontend-list' => 'admin_user_frontend_list',
      'admin-user_frontend-add' => 'admin_user_frontend_add',
      'admin-user_frontend-edit' => 'admin_user_frontend_edit',
      'admin-user_frontend-delete' => 'admin_user_frontend_delete',
      'admin-user_frontend-active' => 'admin_user_frontend_active',
      'admin-user_frontend-transfer-point' => 'admin_user_frontend_transfer_point',
      'role-list' => 'role_list',
      'role-add' => 'role_add',
      'role-edit' => 'role_edit',
      'role-delete' => 'role_delete',
      'permission-list' => 'permission_list',
      'permission-add' => 'permission_add',
      'permission-edit' => 'permission_edit',
      'permission-delete' => 'permission_delete',
      'pay-list' => 'pay_list',
      'pay-add' => 'pay_add',
      'pay-edit' => 'pay_edit',
      'pay-delete' => 'pay_delete',
      'pay-update-draw-point' => 'pay_update_draw_point',
      'pay-export-excel' => 'pay_export_excel',
      'bank-list' => 'bank_list',
      'bank-add' => 'bank_add',
      'bank-edit' => 'bank_edit',
      'bank-delete' => 'bank_delete',
      'store-list' => 'store_list',
      'store-input' => 'store_input',
      'transaction-list' => 'transaction_list',
      'transaction-status' => 'transaction_status',
      'transaction-delete' => 'transaction_delete',
    ),
    'table_module' => 
    array (
      0 => 'category_product',
      1 => 'category_post',
      2 => 'slider',
      3 => 'menu',
      4 => 'product',
      5 => 'post',
      6 => 'setting',
      7 => 'admin',
      8 => 'role',
      9 => 'permission',
    ),
    'module_childrent' => 
    array (
      0 => 'list',
      1 => 'add',
      2 => 'edit',
      3 => 'delete',
    ),
  ),
  'point' => 
  array (
    'typePoint' => 
    array (
      1 => 
      array (
        'type' => 1,
        'name' => 'Điểm được thưởng khi tạo tài khoản',
      ),
      2 => 
      array (
        'type' => 2,
        'name' => 'Điểm thưởng hệ thống',
      ),
      3 => 
      array (
        'type' => 3,
        'name' => 'Điểm thưởng tiêu dùng',
      ),
      4 => 
      array (
        'type' => 4,
        'name' => 'Nạp từ thành viên',
      ),
      5 => 
      array (
        'type' => 5,
        'name' => 'Rút tiền',
      ),
      6 => 
      array (
        'type' => 6,
        'name' => 'Mua sản phẩm',
      ),
      7 => 
      array (
        'type' => 7,
        'name' => 'Hoàn điểm',
      ),
      8 => 
      array (
        'type' => 8,
        'name' => 'Điểm được bắn từ admin',
      ),
      'defaultPoint' => 100,
      'pointReward' => 10,
    ),
    'rose' => 
    array (
      1 => 
      array (
        'row' => 1,
        'percent' => 8,
      ),
      2 => 
      array (
        'row' => 2,
        'percent' => 5,
      ),
      3 => 
      array (
        'row' => 3,
        'percent' => 3,
      ),
      4 => 
      array (
        'row' => 4,
        'percent' => 2,
      ),
      5 => 
      array (
        'row' => 5,
        'percent' => 1,
      ),
      6 => 
      array (
        'row' => 6,
        'percent' => 1,
      ),
      7 => 
      array (
        'row' => 7,
        'percent' => 1,
      ),
      8 => 
      array (
        'row' => 8,
        'percent' => 1,
      ),
      9 => 
      array (
        'row' => 9,
        'percent' => 1,
      ),
      10 => 
      array (
        'row' => 11,
        'percent' => 1,
      ),
      11 => 
      array (
        'row' => 11,
        'percent' => 0.5,
      ),
      12 => 
      array (
        'row' => 12,
        'percent' => 0.5,
      ),
      13 => 
      array (
        'row' => 13,
        'percent' => 0.5,
      ),
      14 => 
      array (
        'row' => 14,
        'percent' => 0.5,
      ),
      15 => 
      array (
        'row' => 15,
        'percent' => 0.5,
      ),
      16 => 
      array (
        'row' => 16,
        'percent' => 0.5,
      ),
      17 => 
      array (
        'row' => 17,
        'percent' => 0.5,
      ),
      18 => 
      array (
        'row' => 18,
        'percent' => 0.5,
      ),
      19 => 
      array (
        'row' => 19,
        'percent' => 0.5,
      ),
      20 => 
      array (
        'row' => 20,
        'percent' => 0.5,
      ),
    ),
    'typePay' => 
    array (
      1 => 
      array (
        'type' => 1,
        'name' => 'Đang chờ xử lý',
      ),
      2 => 
      array (
        'type' => 2,
        'name' => 'Đã rút thành công',
      ),
      3 => 
      array (
        'type' => 3,
        'name' => 'Rút không thành công. Đã hoàn điểm lại',
      ),
    ),
    'typeStore' => 
    array (
      1 => 
      array (
        'type' => 1,
        'name' => 'Nhập kho',
      ),
      2 => 
      array (
        'type' => 2,
        'name' => 'Đã đặt hàng đang chờ xuất kho',
      ),
      3 => 
      array (
        'type' => 3,
        'name' => 'Xuất kho',
      ),
    ),
    'datePay' => 
    array (
      'start' => 1,
      'end' => 30,
    ),
    'transferPointDefault' => 10,
    'pointUnit' => 'Điểm',
    'pointToMoney' => 1000,
    'namePointDefault' => 'Phạm Văn Hưng',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'suffix' => NULL,
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\laragon\\www\\demo22\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'demo22bivaconet_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\laragon\\www\\demo22\\resources\\views',
    ),
    'compiled' => 'C:\\laragon\\www\\demo22\\storage\\framework\\views',
  ),
  'web_default' => 
  array (
    'frontend' => 
    array (
      'noImage' => '/frontend/images/noimage.jpg',
      'userNoImage' => '/frontend/images/usernoimage.png',
    ),
    'backend' => 
    array (
      'noImage' => '/admin_asset/images/noimage.png',
      'userNoImage' => '/admin_asset/images/usernoimage.png',
    ),
    'priceSearch' => 
    array (
      1 => 
      array (
        'value' => 1,
        'start' => 0,
        'end' => 500000,
        'name' => 'Dưới 500 nghìn',
      ),
      2 => 
      array (
        'value' => 2,
        'start' => 500000,
        'end' => 1000000,
        'name' => 'Từ 500 nghìn - 1 triệu',
      ),
      3 => 
      array (
        'value' => 3,
        'start' => 1000000,
        'end' => 3000000,
        'name' => 'Từ 1 triệu - 3 triệu',
      ),
      4 => 
      array (
        'value' => 4,
        'start' => 3000000,
        'end' => 5000000,
        'name' => 'Từ 3 triệu - 5 triệu',
      ),
      5 => 
      array (
        'value' => 5,
        'start' => 5000000,
        'end' => 10000000,
        'name' => 'Từ 5 triệu - 10 triệu',
      ),
      6 => 
      array (
        'value' => 6,
        'start' => 10000000,
        'end' => 20000000,
        'name' => 'Từ 10 triệu - 20 triệu',
      ),
      7 => 
      array (
        'value' => 7,
        'start' => 20000000,
        'end' => 50000000,
        'name' => 'Từ 20 triệu - 50 triệu',
      ),
      8 => 
      array (
        'value' => 8,
        'start' => 50000000,
        'end' => NULL,
        'name' => 'Trên 50 triệu',
      ),
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'lfm-config' => 
  array (
    'use_package_routes' => true,
    'allow_private_folder' => true,
    'private_folder_name' => 'UniSharp\\LaravelFilemanager\\Handlers\\ConfigHandler',
    'allow_shared_folder' => true,
    'shared_folder_name' => 'shares',
    'folder_categories' => 
    array (
      'file' => 
      array (
        'folder_name' => 'files',
        'startup_view' => 'list',
        'max_size' => 50000,
        'thumb' => true,
        'thumb_width' => 80,
        'thumb_height' => 80,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
          4 => 'application/pdf',
          5 => 'text/plain',
        ),
      ),
      'image' => 
      array (
        'folder_name' => 'photos',
        'startup_view' => 'grid',
        'max_size' => 50000,
        'thumb' => true,
        'thumb_width' => 80,
        'thumb_height' => 80,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
        ),
      ),
    ),
    'paginator' => 
    array (
      'perPage' => 30,
    ),
    'disk' => 'public',
    'rename_file' => false,
    'rename_duplicates' => false,
    'alphanumeric_filename' => false,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'should_validate_mime' => true,
    'over_write_on_duplicate' => false,
    'disallowed_mimetypes' => 
    array (
      0 => 'text/x-php',
      1 => 'text/html',
      2 => 'text/plain',
    ),
    'disallowed_extensions' => 
    array (
      0 => 'php',
      1 => 'html',
    ),
    'item_columns' => 
    array (
      0 => 'name',
      1 => 'url',
      2 => 'time',
      3 => 'icon',
      4 => 'is_file',
      5 => 'is_image',
      6 => 'thumb_url',
    ),
    'should_create_thumbnails' => true,
    'thumb_folder_name' => 'thumbs',
    'raster_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
    ),
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => 
    array (
      'pdf' => 'Adobe Acrobat',
      'doc' => 'Microsoft Word',
      'docx' => 'Microsoft Word',
      'xls' => 'Microsoft Excel',
      'xlsx' => 'Microsoft Excel',
      'zip' => 'Archive',
      'gif' => 'GIF Image',
      'jpg' => 'JPEG Image',
      'jpeg' => 'JPEG Image',
      'png' => 'PNG Image',
      'ppt' => 'Microsoft PowerPoint',
      'pptx' => 'Microsoft PowerPoint',
    ),
    'php_ini_overrides' => 
    array (
      'memory_limit' => '256M',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
