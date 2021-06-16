<?php

namespace ps_hesabfa\Controller;

use Doctrine\Common\Cache\CacheProvider;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class ImportExportController extends FrameworkBundleAdminController
{

    // you can use symfony DI to inject services
    public function __construct()
    {
    }

    public function importExportAction()
    {
        //return new Response("hello fucking prestashop");
        return $this->render('@Modules/ps_hesabfa/views/templates/admin/importExport.tpl');
    }
}