<?php

//include_once __DIR__ . '/autoloader.php';
//spl_autoload_register(array('NamespaceAutoloader', 'autoload'));


$composerAutoload = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../autoload.php',
];
$vendorPath = null;
foreach ($composerAutoload as $autoload) {
    if (file_exists($autoload)) {
        require($autoload);
        $vendorPath = dirname($autoload);
        break;
    }
}