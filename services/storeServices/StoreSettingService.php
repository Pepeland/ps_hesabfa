<?php

interface IStoreSettingService {
    public function setSetting($key, $value);
    public function getSetting($key);
}

class StoreSettingService implements IStoreSettingService
{
    public function setSetting($key, $value)
    {
        Configuration::updateValue($key, $value);
    }

    public function getSetting($key)
    {
        return Configuration::get($key);
    }
}