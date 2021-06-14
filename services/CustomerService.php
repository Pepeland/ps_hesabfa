<?php

interface ICustomerService {
    public function addOrUpdateCustomer(ApiContact $contact);
    public function deleteCustomer(ApiContact $contact);
    public function addContactRelationBetweenHesabfaAndPs(ApiContact $contact);
    public function deleteContactRelationBetweenHesabfaAndPs(ApiContact $contact);
}

class CustomerService implements ICustomerService
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


    public function addContactRelationBetweenHesabfaAndPs(ApiContact $contact)
    {

    }

    public function deleteContactRelationBetweenHesabfaAndPs(ApiContact $contact)
    {

    }
}