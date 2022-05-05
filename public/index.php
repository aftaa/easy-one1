<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

spl_autoload_register(/**
 * @throws Exception
 */ function (string $classname) {
    $filename = str_replace('\\', '/', $classname);
    $filename .= '.php';
//    if (!file_exists($filename)) {
//        header('HTTP/1.0 404 Not Found');
//        throw new Exception("require_once error: filename $filename for classname $classname not found");
//    }
    require_once $filename;
});
chdir('..');
session_start();

(new \easy\Application(
    \easy\basic\startup\DebugMode::true,
    \easy\basic\startup\Environment::DEV))->run();
