#!/usr/bin/env php56
<?php
/**
 * Command line version of the application's phpInfo() task accessible via http://{application-uri}/?__phpinfo__.
 */
use rosasurfer\util\PHP;

require(dirname(realpath(__FILE__)).'/../app/init.php');

PHP::phpinfo();
echo PHP_EOL.'loaded php.ini: "'.php_ini_loaded_file().'"'.PHP_EOL;
