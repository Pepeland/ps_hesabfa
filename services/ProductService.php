<?php


class ProductService
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new ProductService();
        return self::$instance;
    }
}