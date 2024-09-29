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

        parent::__construct();

        $this->displayName = $this->l('Smart Banner');
        $this->description = $this->l('Muestra un Smart Banner para aplicaciones móviles.');
        $this->ps_versions_compliancy = ['min' => '8.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayHeader') &&
            Configuration::updateValue('SMARTBANNER_TITLE', 'Smart Application') &&
            Configuration::updateValue('SMARTBANNER_AUTHOR', 'SmartBanner Contributors') &&
            Configuration::updateValue('SMARTBANNER_PRICE', 'FREE') &&
            Configuration::updateValue('SMARTBANNER_ICON_GOOGLE', '') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_GOOGLE', '') &&
            Configuration::updateValue('SMARTBANNER_ENABLED_PLATFORMS', 'android') && // Solo android
            Configuration::updateValue('SMARTBANNER_APP_ID', '6453519053') && // Nuevo campo
            Configuration::updateValue('SMARTBANNER_APP_URL', 'https://apps.apple.com/us/app/pedraja/id6453519053?itsct=apps_box_link&itscg=30200'); // Nuevo campo
    }

    public function uninstall()
    {
        return parent::uninstall() &&
            Configuration::deleteByName('SMARTBANNER_TITLE') &&
            Configuration::deleteByName('SMARTBANNER_AUTHOR') &&
            Configuration::deleteByName('SMARTBANNER_PRICE') &&
            Configuration::deleteByName('SMARTBANNER_ICON_GOOGLE') &&
            Configuration::deleteByName('SMARTBANNER_BUTTON_URL_GOOGLE') &&
            Configuration::deleteByName('SMARTBANNER_ENABLED_PLATFORMS') &&
            Configuration::deleteByName('SMARTBANNER_APP_ID') && // Eliminar nuevo campo
            Configuration::deleteByName('SMARTBANNER_APP_URL'); // Eliminar nuevo campo
    }

    public function getContent()
    {
        if (Tools::isSubmit('submit_smartbanner')) {
            Configuration::updateValue('SMARTBANNER_TITLE', Tools::getValue('SMARTBANNER_TITLE'));
            Configuration::updateValue('SMARTBANNER_AUTHOR', Tools::getValue('SMARTBANNER_AUTHOR'));
            Configuration::updateValue('SMARTBANNER_PRICE', Tools::getValue('SMARTBANNER_PRICE'));
            Configuration::updateValue('SMARTBANNER_ICON_GOOGLE', Tools::getValue('SMARTBANNER_ICON_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_GOOGLE', Tools::getValue('SMARTBANNER_BUTTON_URL_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_ENABLED_PLATFORMS', Tools::getValue('SMARTBANNER_ENABLED_PLATFORMS'));
            Configuration::updateValue('SMARTBANNER_APP_ID', Tools::getValue('SMARTBANNER_APP_ID')); // Guardar app-id
            Configuration::updateValue('SMARTBANNER_APP_URL', Tools::getValue('SMARTBANNER_APP_URL')); // Guardar app URL
        }

        return $this->renderForm();
    }

    public function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->allow_employee_form_lang = $helper->default_form_language;

        $helper->submit_action = 'submit_smartbanner';

        // Carga de valores actuales en el formulario
        $helper->fields_value['SMARTBANNER_TITLE'] = Configuration::get('SMARTBANNER_TITLE');
        $helper->fields_value['SMARTBANNER_AUTHOR'] = Configuration::get('SMARTBANNER_AUTHOR');
        $helper->fields_value['SMARTBANNER_PRICE'] = Configuration::get('SMARTBANNER_PRICE');
        $helper->fields_value['SMARTBANNER_ICON_GOOGLE'] = Configuration::get('SMARTBANNER_ICON_GOOGLE');
        $helper->fields_value['SMARTBANNER_BUTTON_URL_GOOGLE'] = Configuration::get('SMARTBANNER_BUTTON_URL_GOOGLE');
        $helper->fields_value['SMARTBANNER_ENABLED_PLATFORMS'] = Configuration::get('SMARTBANNER_ENABLED_PLATFORMS');
        $helper->fields_value['SMARTBANNER_APP_ID'] = Configuration::get('SMARTBANNER_APP_ID'); // Cargar valor del app-id
        $helper->fields_value['SMARTBANNER_APP_URL'] = Configuration::get('SMARTBANNER_APP_URL'); // Cargar valor de la URL

        $fields_form = [
            'form' => [
                'legend' => [
                    'title' => $this->l('Configuración del Smart Banner'),
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->l('Título'),
                        'name' => 'SMARTBANNER_TITLE',
                        'required' => true,
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Autor'),
                        'name' => 'SMARTBANNER_AUTHOR',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Precio'),
                        'name' => 'SMARTBANNER_PRICE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Icono Google URL'),
                        'name' => 'SMARTBANNER_ICON_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('URL del botón Google'),
                        'name' => 'SMARTBANNER_BUTTON_URL_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Plataformas habilitadas (ej: android,ios)'),
                        'name' => 'SMARTBANNER_ENABLED_PLATFORMS',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('App ID de Apple'),
                        'name' => 'SMARTBANNER_APP_ID',
                        'required' => true,
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('URL de la App de Apple'),
                        'name' => 'SMARTBANNER_APP_URL',
                        'required' => true,
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Guardar'),
                ],
            ],
        ];

        return $helper->generateForm([$fields_form]);
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->registerStylesheet(
            'module-smartbanner-style',
            'modules/'.$this->name.'/views/css/smartbanner.min.css',
            ['media' => 'all', 'priority' => 150]
        );

        $this->context->controller->registerJavascript(
            'module-smartbanner-script',
            'modules/'.$this->name.'/views/js/smartbanner.min.js',
            ['position' => 'bottom', 'priority' => 150]
        );
        
        $is_mobile = $this->context->isMobile();
        if (!$is_mobile) {
            return;
        }

        $this->context->smarty->assign([
            'smartbanner' => [
                'title' => Configuration::get('SMARTBANNER_TITLE'),
                'author' => Configuration::get('SMARTBANNER_AUTHOR'),
                'price' => Configuration::get('SMARTBANNER_PRICE'),
                'icon_google' => Configuration::get('SMARTBANNER_ICON_GOOGLE'),
                'button_url_google' => Configuration::get('SMARTBANNER_BUTTON_URL_GOOGLE'),
                'enabled_platforms' => Configuration::get('SMARTBANNER_ENABLED_PLATFORMS'),
                'app_id' => Configuration::get('SMARTBANNER_APP_ID'), // Nueva variable para el app-id
                'app_url' => Configuration::get('SMARTBANNER_APP_URL'), // Nueva variable para la URL
            ],
        ]);

        return $this->display(__FILE__, 'views/templates/front/smartbanner.tpl');
    }
}

