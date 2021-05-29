<?php
namespace App\services;

class Autoloader
{
    /**
     * Подключаем класс
     * @param $className
     */
    public function loadClass($className)
    {
        $file = str_replace(
                ['App\\', '\\'],
                [dirname(__DIR__) . '/', DIRECTORY_SEPARATOR],
                $className) . '.php';
        if (is_file($file)) {
            include $file;
        }
    }

}
