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
        $this->author = 'Tu Nombre';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Smart Banner');
        $this->description = $this->l('Un módulo para mostrar un smart banner para aplicaciones móviles.');
        $this->ps_versions_compliancy = ['min' => '8.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayHeader') &&
            $this->registerHook('displayFooter') &&
            Configuration::updateValue('SMARTBANNER_TITLE', 'Smart Application') &&
            Configuration::updateValue('SMARTBANNER_AUTHOR', 'SmartBanner Contributors') &&
            Configuration::updateValue('SMARTBANNER_PRICE', 'FREE') &&
            Configuration::updateValue('SMARTBANNER_ICON_APPLE', '') &&
            Configuration::updateValue('SMARTBANNER_ICON_GOOGLE', '') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_LABEL', 'Ver') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_APPLE', '') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_GOOGLE', '') &&
            Configuration::updateValue('SMARTBANNER_ENABLED_PLATFORMS', 'android,ios') &&
            Configuration::updateValue('SMARTBANNER_CLOSE_LABEL', 'Cerrar este banner');
    }

    public function uninstall()
    {
        return parent::uninstall() &&
            Configuration::deleteByName('SMARTBANNER_TITLE') &&
            Configuration::deleteByName('SMARTBANNER_AUTHOR') &&
            Configuration::deleteByName('SMARTBANNER_PRICE') &&
            Configuration::deleteByName('SMARTBANNER_ICON_APPLE') &&
            Configuration::deleteByName('SMARTBANNER_ICON_GOOGLE') &&
            Configuration::deleteByName('SMARTBANNER_BUTTON_LABEL') &&
            Configuration::deleteByName('SMARTBANNER_BUTTON_URL_APPLE') &&
            Configuration::deleteByName('SMARTBANNER_BUTTON_URL_GOOGLE') &&
            Configuration::deleteByName('SMARTBANNER_ENABLED_PLATFORMS') &&
            Configuration::deleteByName('SMARTBANNER_CLOSE_LABEL');
    }

    public function getContent()
    {
        if (Tools::isSubmit('submit_smartbanner')) {
            Configuration::updateValue('SMARTBANNER_TITLE', Tools::getValue('SMARTBANNER_TITLE'));
            Configuration::updateValue('SMARTBANNER_AUTHOR', Tools::getValue('SMARTBANNER_AUTHOR'));
            Configuration::updateValue('SMARTBANNER_PRICE', Tools::getValue('SMARTBANNER_PRICE'));
            Configuration::updateValue('SMARTBANNER_ICON_APPLE', Tools::getValue('SMARTBANNER_ICON_APPLE'));
            Configuration::updateValue('SMARTBANNER_ICON_GOOGLE', Tools::getValue('SMARTBANNER_ICON_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_BUTTON_LABEL', Tools::getValue('SMARTBANNER_BUTTON_LABEL'));
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_APPLE', Tools::getValue('SMARTBANNER_BUTTON_URL_APPLE'));
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_GOOGLE', Tools::getValue('SMARTBANNER_BUTTON_URL_GOOGLE'));
            Configuration::updateValue('SMARTBANNER_ENABLED_PLATFORMS', Tools::getValue('SMARTBANNER_ENABLED_PLATFORMS'));
            Configuration::updateValue('SMARTBANNER_CLOSE_LABEL', Tools::getValue('SMARTBANNER_CLOSE_LABEL'));
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

        // Carga los valores actuales en el formulario
        $helper->fields_value['SMARTBANNER_TITLE'] = Configuration::get('SMARTBANNER_TITLE');
        $helper->fields_value['SMARTBANNER_AUTHOR'] = Configuration::get('SMARTBANNER_AUTHOR');
        $helper->fields_value['SMARTBANNER_PRICE'] = Configuration::get('SMARTBANNER_PRICE');
        $helper->fields_value['SMARTBANNER_ICON_APPLE'] = Configuration::get('SMARTBANNER_ICON_APPLE');
        $helper->fields_value['SMARTBANNER_ICON_GOOGLE'] = Configuration::get('SMARTBANNER_ICON_GOOGLE');
        $helper->fields_value['SMARTBANNER_BUTTON_LABEL'] = Configuration::get('SMARTBANNER_BUTTON_LABEL');
        $helper->fields_value['SMARTBANNER_BUTTON_URL_APPLE'] = Configuration::get('SMARTBANNER_BUTTON_URL_APPLE');
        $helper->fields_value['SMARTBANNER_BUTTON_URL_GOOGLE'] = Configuration::get('SMARTBANNER_BUTTON_URL_GOOGLE');
        $helper->fields_value['SMARTBANNER_ENABLED_PLATFORMS'] = Configuration::get('SMARTBANNER_ENABLED_PLATFORMS');
        $helper->fields_value['SMARTBANNER_CLOSE_LABEL'] = Configuration::get('SMARTBANNER_CLOSE_LABEL');

        // Definición del formulario
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
                        'label' => $this->l('Icono Apple URL'),
                        'name' => 'SMARTBANNER_ICON_APPLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Icono Google URL'),
                        'name' => 'SMARTBANNER_ICON_GOOGLE',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Etiqueta del botón'),
                        'name' => 'SMARTBANNER_BUTTON_LABEL',
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('URL del botón Apple'),
                        'name' => 'SMARTBANNER_BUTTON_URL_APPLE',
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
                        'label' => $this->l('Etiqueta de cerrar'),
                        'name' => 'SMARTBANNER_CLOSE_LABEL',
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Guardar'),
                ],
            ],
        ];

        // Generar el formulario
        return $helper->generateForm([$fields_form]);
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->registerStylesheet('module-smartbanner', 'modules/' . $this->name . '/smartbanner.css');
        $this->context->controller->registerJavascript('module-smartbanner', 'modules/' . $this->name . '/smartbanner.js');
        
        $this->context->smarty->assign([
            'smartbanner' => [
                'title' => Configuration::get('SMARTBANNER_TITLE'),
                'author' => Configuration::get('SMARTBANNER_AUTHOR'),
                'price' => Configuration::get('SMARTBANNER_PRICE'),
                'icon_apple' => Configuration::get('SMARTBANNER_ICON_APPLE'),
                'icon_google' => Configuration::get('SMARTBANNER_ICON_GOOGLE'),
                'button_label' => Configuration::get('SMARTBANNER_BUTTON_LABEL'),
                'button_url_apple' => Configuration::get('SMARTBANNER_BUTTON_URL_APPLE'),
                'button_url_google' => Configuration::get('SMARTBANNER_BUTTON_URL_GOOGLE'),
                'enabled_platforms' => Configuration::get('SMARTBANNER_ENABLED_PLATFORMS'
