<?php


class InvoiceService
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new InvoiceService();
        return self::$instance;
    }
}