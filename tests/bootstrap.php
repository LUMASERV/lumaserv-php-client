<?php

$autoload = dirname(__DIR__).'/vendor/autoload.php';
if (!file_exists($autoload)) {
    echo "Please install project runing:\n\tcomposer install\n\n";
    exit("Download composer at https://getcomposer.org/download/\n\n");
}
$loader = include $autoload;
$loader->addPsr4('LumaservSystems\\', __DIR__);
$loader->addPsr4('CustomClasses\\', __DIR__.'/CustomClasses');
