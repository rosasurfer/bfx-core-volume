<?php
declare(strict_types=1);

use rosasurfer\ministruts\Application;
use rosasurfer\ministruts\util\PHP;

use const rosasurfer\ministruts\CLI;


// class loader
require(($appRoot=dirname(__DIR__)).'/vendor/autoload.php');


// php.ini settings
error_reporting(E_ALL & ~E_DEPRECATED);

PHP::ini_set('log_errors',      '1'                          );
PHP::ini_set('error_log',       $appRoot.'/log/php-error.log');
PHP::ini_set('default_charset', 'UTF-8'                      );


// create a new application
return new Application([
    'app.dir.root'   => $appRoot,
    'app.dir.config' => $appRoot.'/config',
]);
