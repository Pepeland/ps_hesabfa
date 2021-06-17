<?php
/**
 * 2007-2021 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2021 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Ps_hesabfa extends Module
{
    protected $config_form = false;

//    public $tabs = [
//        [
//            'name' => 'Hesabfa Import and Export', // One name for all langs
//            'class_name' => 'ImportExportController',
//            'visible' => true,
//            'parent_class_name' => 'DEFAULT',
//        ],
//    ];

    public function __construct()
    {
        $this->name = 'ps_hesabfa';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Hesabfa';
        $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Hesabfa');
        $this->description = $this->l('Hesabfa Online Accounting Software.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall Hesabfa module? Notice that relation table between Hesabfa and Prestashop  will be deleted.');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('PS_HESABFA_LIVE_MODE', false);

        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('actionCustomerAccountAdd') &&
            $this->registerHook('actionOrderStatusUpdate') &&
            $this->registerHook('actionPaymentConfirmation') &&
            $this->registerHook('actionProductAdd') &&
            $this->registerHook('actionProductDelete') &&
            $this->registerHook('actionProductUpdate') &&
            $this->CreateMymoduleAdminTabs();
    }

    public function uninstall()
    {
        Configuration::deleteByName('PS_HESABFA_LIVE_MODE');

        include(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall() &&
            $this->uninstallTab();
    }

    private function CreateMymoduleAdminTabs() {
        $langs = Language::getLanguages();
        $smarttab = new Tab();
        $smarttab->class_name = "ImportExportController";
        $smarttab->module = "";
        $smarttab->id_parent = 0;
        $smarttab->name = "Menu Test Hesabfa";
        $smarttab->save();
        $tab_id = $smarttab->id;
        $subMenus = array(
            array(
                'class_name' => 'AdminMenu1',
                'id_parent' => 15,
                'module' => 'ps_hesabfa',
                'name' => 'tabName1',
            ),
            array(
                'class_name' => 'AdminMenu2',
                'id_parent' => 15,
                'module' => 'ps_hesabfa',
                'name' => 'tabName2',
            ),
            array(
                'class_name' => 'AdminMenu3',
                'id_parent' => 15,
                'module' => 'ps_hesabfa',
                'name' => 'tabName3',
            ),
        );
        foreach ($subMenus as $tab) {
            $newtab = new Tab();
            $newtab->class_name = $tab['class_name'];
            $newtab->id_parent = $tab_id;
            $newtab->module = $tab['module'];
            $newtab->name = $tab['name'];
            $newtab->save();
        }
        return true;
    }

    private function installTab()
    {
        $tab = new Tab(1000);
        $tab->active = 1;
        $tab->class_name = 'ImportExportController';
        // Only since 1.7.7, you can define a route name
        $tab->route_name = 'ps_hesabfa_rout';
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = $this->trans('Hesabfa', array(), 'Modules.ps_hesabfa.Admin', $lang['locale']);
        }
        $tab->id_parent = (int) Tab::getIdFromClassName('CONFIGURE');
        $tab->module = '';

        return $tab->save();
    }

    private function installTab2()
    {
        $tab = new Tab(1001);
        $tab->active = 1;
        $tab->class_name = 'ImportExportController';
        // Only since 1.7.7, you can define a route name
        $tab->route_name = 'ps_hesabfa_rout';
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = $this->trans('Import Export Hesabfa', array(), 'Modules.ps_hesabfa.Admin', $lang['locale']);
        }
        $tab->id_parent = 1000;
        $tab->module = $this->name;

        return $tab->save();
    }

    private function uninstallTab()
    {
        $tabId = (int)Tab::getIdFromClassName('ImportExportController');
        if (!$tabId) {
            return true;
        }

        $tab = new Tab($tabId);

        return $tab->delete();
    }

    public function enable($force_all = false)
    {
        return parent::enable($force_all)
            && $this->installTab()
            && $this->installTab2();
    }

    public function disable($force_all = false)
    {
        return parent::disable($force_all)
            && $this->uninstallTab();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitPs_hesabfaModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path . 'views/templates/admin/configure.tpl');

        return $output . $this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPs_hesabfaModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'PS_HESABFA_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'PS_HESABFA_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'PS_HESABFA_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'PS_HESABFA_LIVE_MODE' => Configuration::get('PS_HESABFA_LIVE_MODE', true),
            'PS_HESABFA_ACCOUNT_EMAIL' => Configuration::get('PS_HESABFA_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'PS_HESABFA_ACCOUNT_PASSWORD' => Configuration::get('PS_HESABFA_ACCOUNT_PASSWORD', null),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path . '/views/js/front.js');
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
    }

    public function hookActionCustomerAccountAdd()
    {
        /* Place your code here. */
    }

    public function hookActionOrderStatusUpdate()
    {
        /* Place your code here. */
    }

    public function hookActionPaymentConfirmation()
    {
        /* Place your code here. */
    }

    public function hookActionProductAdd()
    {
        /* Place your code here. */
    }

    public function hookActionProductDelete()
    {
        /* Place your code here. */
    }

    public function hookActionProductUpdate()
    {
        /* Place your code here. */
    }
}
