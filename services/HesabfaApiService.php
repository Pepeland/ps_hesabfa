<?php


class HesabfaApiService
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new HesabfaApiService();
        return self::$instance;
    }
}