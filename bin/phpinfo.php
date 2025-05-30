#!/usr/bin/env php
<?php
declare(strict_types=1);

/**
 * Command line version of phpInfo()
 */
use rosasurfer\ministruts\util\PHP;

require(__DIR__.'/../app/init.php');

PHP::phpinfo();
echo PHP_EOL.'loaded php.ini: "'.php_ini_loaded_file().'"'.PHP_EOL;
