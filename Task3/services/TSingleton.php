<?php
namespace App\services;

trait TSingleton
{
    private static $instance;

    protected function __construct(){}
    protected function __clone(){}
    protected function __wakeup(){}

    public static function getInstance()
    {
        return static::$instance
            ??
            static::$instance = new self();
    }
}
