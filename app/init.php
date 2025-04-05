<?php
use rosasurfer\Application;
use rosasurfer\util\PHP;

use const rosasurfer\CLI;

// class loader
require(($appRoot=dirname(__DIR__)).'/vendor/autoload.php');


// php.ini settings
error_reporting(E_ALL & ~E_DEPRECATED);
PHP::ini_set('display_errors',     (string)(int)CLI             );
PHP::ini_set('html_errors',        '0'                          );
PHP::ini_set('error_log',          $appRoot.'/log/php-error.log');
PHP::ini_set('log_errors',         '1'                          );
PHP::ini_set('log_errors_max_len', '0'                          );
PHP::ini_set('default_charset',    'UTF-8'                      );


// create a new application
return new Application([
    'app.dir.root'   => $appRoot,
    'app.dir.config' => __DIR__.'/config',
]);
