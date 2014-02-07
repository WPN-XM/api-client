<?php

date_default_timezone_set('Europe/Berlin');

// Composer Autoloader
if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    include_once __DIR__ . '/../vendor/autoload.php';
} else {
    echo '[Error] Tests > Bootstrap: Could not find "vendor/autoload.php".' . PHP_EOL;
    echo 'Did you forget to run "composer install --dev"?' . PHP_EOL;
    exit(1);
}
