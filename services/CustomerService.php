<?php


class CustomerService
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new CustomerService();
        return self::$instance;
    }

    public function addOrUpdateCustomer(ApiContact $contact)
    {

    }

    public function deleteCustomer(ApiContact $contact) {

    }


}