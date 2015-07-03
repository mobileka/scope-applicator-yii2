<?php

require 'vendor/autoload.php';
require 'vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';
require 'tests/TestCase.php';
require 'vendor/yiisoft/yii2/Yii.php';

spl_autoload_register(function ($class) {
    $file = __DIR__.'/tests/'. str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});
