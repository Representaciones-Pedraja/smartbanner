<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class SmartBanner extends Module
{
    public function __construct()
    {
        $this->name = 'smartbanner';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Jose Manuel Pedraja';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0', 'max' => _PS_VERSION_];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Smart Banner');
        $this->description = $this->l('Customisable smart app banner for iOS and Android.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        return parent::install() && $this->registerHook('displayHeader') && $this->registerHook('displayTop');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        $output = '';
        if (Tools::isSubmit('submit'.$this->name)) {
            Configuration::updateValue('SMARTBANNER_TITLE', Tools::getValue('SMARTBANNER_TITLE'));
            Configuration::updateValue('SMARTBANNER_AUTHOR', Tools::getValue('SMARTBANNER_AUTHOR'));
            Configuration::updateValue('SMARTBANNER_PRICE', Tools::getValue('SMARTBANNER_PRICE'));
            Configuration::updateValue('SMARTBANNER_PRICE_SUFFIX_APPLE', Tools::getValue('SMARTBANNER_PRICE_SUFFIX_APPLE'));
            Configuration::updateValue('SMARTBANNER_PRICE_SUFFIX_GOOGLE', Tools::getValue('SMARTBANNER_PRICE_SUFFIX_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_ICON_APPLE', Tools::getValue('SMARTBANNER_ICON_APPLE'));
            Configuration::updateValue('SMARTBANNER_ICON_GOOGLE', Tools::getValue('SMARTBANNER_ICON_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_BUTTON', Tools::getValue('SMARTBANNER_BUTTON'));
            Configuration::updateValue('SMARTBANNER_BUTTON_APPLE', Tools::getValue('SMARTBANNER_BUTTON_APPLE'));
            Configuration::updateValue('SMARTBANNER_BUTTON_GOOGLE', Tools::getValue('SMARTBANNER_BUTTON_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_URL_APPLE', Tools::getValue('SMARTBANNER_URL_APPLE'));
            Configuration::updateValue('SMARTBANNER_URL_GOOGLE', Tools::getValue('SMARTBANNER_URL_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_PLATFORMS', Tools::getValue('SMARTBANNER_PLATFORMS'));
            Configuration::updateValue('SMARTBANNER_CLOSE_LABEL', Tools::getValue('SMARTBANNER_CLOSE_LABEL'));
            Configuration::updateValue('SMARTBANNER_HIDE_TTL', Tools::getValue('SMARTBANNER_HIDE_TTL'));
            Configuration::updateValue('SMARTBANNER_HIDE_PATH', Tools::getValue('SMARTBANNER_HIDE_PATH'));
            Configuration::updateValue('SMARTBANNER_DISABLE_POSITIONING', Tools::getValue('SMARTBANNER_DISABLE_POSITIONING'));
            Configuration::updateValue('SMARTBANNER_USER_AGENT_REGEX', Tools::getValue('SMARTBANNER_USER_AGENT_REGEX'));

            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }

        return $output.$this->renderForm();
    }

    protected function renderForm()
    {
        $fields_form = [
            'form' => [
                'legend' => [
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->l('Title'),
                        'name' => 'SMARTBANNER_TITLE',
                        'required' => true,
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Author'),
                        'name' => 'SMARTBANNER_AUTHOR',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Price'),
                        'name' => 'SMARTBANNER_PRICE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Price Suffix (Apple)'),
                        'name' => 'SMARTBANNER_PRICE_SUFFIX_APPLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Price Suffix (Google)'),
                        'name' => 'SMARTBANNER_PRICE_SUFFIX_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Apple Icon URL'),
                        'name' => 'SMARTBANNER_ICON_APPLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Google Icon URL'),
                        'name' => 'SMARTBANNER_ICON_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Button Text'),
                        'name' => 'SMARTBANNER_BUTTON',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Button Text (Apple)'),
                        'name' => 'SMARTBANNER_BUTTON_APPLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Button Text (Google)'),
                        'name' => 'SMARTBANNER_BUTTON_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Apple URL'),
                        'name' => 'SMARTBANNER_URL_APPLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Google URL'),
                        'name' => 'SMARTBANNER_URL_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Enabled Platforms'),
                        'name' => 'SMARTBANNER_PLATFORMS',
                        'desc' => $this->l('Comma-separated list, e.g., "android,ios"'),
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Close Label Text'),
                        'name' => 'SMARTBANNER_CLOSE_LABEL',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Hide TTL (milliseconds)'),
                        'name' => 'SMARTBANNER_HIDE_TTL',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Hide Path'),
                        'name' => 'SMARTBANNER_HIDE_PATH',
                    ],
                    [
                        'type' => 'switch',
                        'label' => $this->l('Disable Positioning'),
                        'name' => 'SMARTBANNER_DISABLE_POSITIONING',
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            ]
                        ]
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('User Agent Regex'),
                        'name' => 'SMARTBANNER_USER_AGENT_REGEX',
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right'
                ]
            ],
        ];

        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->title = $this->displayName;
        $helper->submit_action = 'submit'.$this->name;

        foreach ($fields_form['form']['input'] as $input) {
            $helper->fields_value[$input['name']] = Configuration::get($input['name']);
        }

        return $helper->generateForm([$fields_form]);
    }

    public function hookDisplayHeader($params)
    {
        $this->context->controller->addCSS($this->_path.'views/assets/css/smartbanner.css');
        $this->context->controller->addJS($this->_path.'views/assets/js/smartbanner.js');
    }

    public function hookDisplayTop($params)
    {
        $this->context->smarty->assign([
            'title' => Configuration::get('SMARTBANNER_TITLE'),
            'author' => Configuration::get('SMARTBANNER_AUTHOR'),
            'price' => Configuration::get('SMARTBANNER_PRICE'),
            'price_suffix_apple' => Configuration::get('SMARTBANNER_PRICE_SUFFIX_APPLE'),
            'price_suffix_google' => Configuration::get('SMARTBANNER_PRICE_SUFFIX_GOOGLE'),
            'icon_apple' => Configuration::get('SMARTBANNER_ICON_APPLE'),
            'icon_google' => Configuration::get('SMARTBANNER_ICON_GOOGLE'),
            'button' => Configuration::get('SMARTBANNER_BUTTON'),
            'button_apple' => Configuration::get('SMARTBANNER_BUTTON_APPLE'),
            'button_google' => Configuration::get('SMARTBANNER_BUTTON_GOOGLE'),
            'url_apple' => Configuration::get('SMARTBANNER_URL_APPLE'),
            'url_google' => Configuration::get('SMARTBANNER_URL_GOOGLE'),
            'platforms' => Configuration::get('SMARTBANNER_PLATFORMS'),
            'close_label' => Configuration::get('SMARTBANNER_CLOSE_LABEL'),
            'hide_ttl' => Configuration::get('SMARTBANNER_HIDE_TTL'),
            'hide_path' => Configuration::get('SMARTBANNER_HIDE_PATH'),
            'disable_positioning' => Configuration::get('SMARTBANNER_DISABLE_POSITIONING'),
            'user_agent_regex' => Configuration::get('SMARTBANNER_USER_AGENT_REGEX'),
        ]);

        return $this->display(__FILE__, 'views/templates/hook/smartbanner.tpl');
    }
}