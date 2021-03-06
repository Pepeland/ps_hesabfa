<?php

interface ISettingService
{
    public function setSetting($key, $value);

    public function getSetting($key);

    public function setApiKeyAndToken($apiKey, $apiToken);

    public function getApiKey();

    public function getApiToken();

    public function testApiConnection($apiKey, $apiToken);

    public function setInWhichStatusAddInvoiceToHesabfa($status);

    public function getInWhichStatusAddInvoiceToHesabfa();

    public function setInWhichStatusAddReturnInvoiceToHesabfa($status);

    public function getInWhichStatusAddReturnInvoiceToHesabfa();

    public function setInWhichStatusAddPaymentReceipt($status);

    public function getInWhichStatusAddPaymentReceipt();

    public function setSyncProductPriceWithHesabfa($value);

    public function getSyncProductPriceWithHesabfa();

    public function setSyncProductQuantityWithHesabfa($value);

    public function getSyncProductQuantityWithHesabfa();

    public function setWhichAddressSentToHesabfa($value);

    public function getWhichAddressSentToHesabfa($value);

    public function setCustomersCategory($value);

    public function getCustomersCategory($value);

    public function setWhichNumberSetAsInvoiceReference($value);

    public function getWhichNumberSetAsInvoiceReference($value);

    public function setPaymentReceiptDestination($paymentMethod, $bankId);

    public function getPaymentReceiptDestination($paymentMethod);

    public function setLastChangesLogId($value);

    public function getLastChangesLogId();

    public function setDebugMode($value);

    public function getDebugMode();
}

class SettingService implements ISettingService
{
    public static $pluginPrefix = "hesabfa_";

    private $storeSettingService;

    public function __construct(IStoreSettingService $storeSettingService)
    {
        $this->$storeSettingService = $storeSettingService;
    }

    public function setSetting($key, $value)
    {
        $this->storeSettingService->setSetting(self::$pluginPrefix . $key, $value);
        //Configuration::updateValue(self::$pluginPrefix . $key, $value);
    }

    public function getSetting($key)
    {
        return $this->storeSettingService->getSetting(self::$pluginPrefix . $key);
        //return Configuration::get(self::$pluginPrefix . $key);
    }

    public function setApiKeyAndToken($apiKey, $apiToken)
    {
        $this->setSetting("apiKey", $apiKey);
        $this->setSetting("apiToken", $apiToken);
    }

    public function getApiKey()
    {
        return $this->getSetting("apiKey");
    }

    public function getApiToken()
    {
        return $this->getSetting("apiToken");
    }

    public function testApiConnection($apiKey, $apiToken)
    {
        // TODO: Implement testApiConnection() method.
    }

    public function setInWhichStatusAddInvoiceToHesabfa($status)
    {
        $this->setSetting("inWhichStatusAddInvoiceToHesabfa", $status);
    }

    public function getInWhichStatusAddInvoiceToHesabfa()
    {
        return $this->getSetting("inWhichStatusAddInvoiceToHesabfa");
    }

    public function setInWhichStatusAddReturnInvoiceToHesabfa($status)
    {
        $this->setSetting("inWhichStatusAddReturnInvoiceToHesabfa", $status);
    }

    public function getInWhichStatusAddReturnInvoiceToHesabfa()
    {
        return $this->getSetting("inWhichStatusAddReturnInvoiceToHesabfa");
    }

    public function setInWhichStatusAddPaymentReceipt($status)
    {
        $this->setSetting("inWhichStatusAddPaymentReceipt", $status);
    }

    public function getInWhichStatusAddPaymentReceipt()
    {
        return $this->getSetting("inWhichStatusAddPaymentReceipt");
    }

    public function setSyncProductPriceWithHesabfa($value)
    {
        $this->setSetting("syncProductPriceWithHesabfa", $value);
    }

    public function getSyncProductPriceWithHesabfa()
    {
        return $this->getSetting("syncProductPriceWithHesabfa");
    }

    public function setSyncProductQuantityWithHesabfa($value)
    {
        $this->setSetting("syncProductQuantityWithHesabfa", $value);
    }

    public function getSyncProductQuantityWithHesabfa()
    {
        return $this->getSetting("syncProductQuantityWithHesabfa");
    }

    public function setWhichAddressSentToHesabfa($value)
    {
        $this->setSetting("whichAddressSentToHesabfa", $value);
    }

    public function getWhichAddressSentToHesabfa($value)
    {
        return $this->getSetting("whichAddressSentToHesabfa");
    }

    public function setCustomersCategory($value)
    {
        $this->setSetting("customerCategory", $value);
    }

    public function getCustomersCategory($value)
    {
        return $this->getSetting("customerCategory");
    }

    public function setWhichNumberSetAsInvoiceReference($value)
    {
        $this->setSetting("whichNumberSetAsInvoiceReference", $value);
    }

    public function getWhichNumberSetAsInvoiceReference($value)
    {
        return $this->getSetting("whichNumberSetAsInvoiceReference");
    }

    public function setPaymentReceiptDestination($paymentMethod, $bankId)
    {
        $this->setSetting("paymentReceiptDestination_" . $paymentMethod, $bankId );
    }

    public function getPaymentReceiptDestination($paymentMethod)
    {
        return $this->getSetting("paymentReceiptDestination_" . $paymentMethod);
    }

    public function setLastChangesLogId($value)
    {
        $this->setSetting("lastChangesLogId", $value);
    }

    public function getLastChangesLogId()
    {
        return $this->getSetting("lastChangesLogId");
    }

    public function setDebugMode($value)
    {
        $this->setSetting("debugMode", $value);
    }

    public function getDebugMode()
    {
        return $this->getSetting("debugMode");
    }
}