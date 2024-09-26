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
        $this->description = $this->l('Inserta un smartbanner para aplicaciones móviles.');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('header') &&
            Configuration::updateValue('SMARTBANNER_TITLE', '') &&
            Configuration::updateValue('SMARTBANNER_AUTHOR', '') &&
            Configuration::updateValue('SMARTBANNER_PRICE', '') &&
            Configuration::updateValue('SMARTBANNER_ICON_APPLE', '') &&
            Configuration::updateValue('SMARTBANNER_ICON_GOOGLE', '') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_LABEL', '') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_APPLE', '') &&
            Configuration::updateValue('SMARTBANNER_BUTTON_URL_GOOGLE', '') &&
            Configuration::updateValue('SMARTBANNER_ENABLED_PLATFORMS', '') &&
            Configuration::updateValue('SMARTBANNER_CLOSE_LABEL', '');
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
        $output = '';
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
            $output .= $this->displayConfirmation($this->l('Configuración actualizada'));
        }

        $this->context->smarty->assign([
            'SMARTBANNER_TITLE' => Configuration::get('SMARTBANNER_TITLE'),
            'SMARTBANNER_AUTHOR' => Configuration::get('SMARTBANNER_AUTHOR'),
            'SMARTBANNER_PRICE' => Configuration::get('SMARTBANNER_PRICE'),
            'SMARTBANNER_ICON_APPLE' => Configuration::get('SMARTBANNER_ICON_APPLE'),
            'SMARTBANNER_ICON_GOOGLE' => Configuration::get('SMARTBANNER_ICON_GOOGLE'),
            'SMARTBANNER_BUTTON_LABEL' => Configuration::get('SMARTBANNER_BUTTON_LABEL'),
            'SMARTBANNER_BUTTON_URL_APPLE' => Configuration::get('SMARTBANNER_BUTTON_URL_APPLE'),
            'SMARTBANNER_BUTTON_URL_GOOGLE' => Configuration::get('SMARTBANNER_BUTTON_URL_GOOGLE'),
            'SMARTBANNER_ENABLED_PLATFORMS' => Configuration::get('SMARTBANNER_ENABLED_PLATFORMS'),
            'SMARTBANNER_CLOSE_LABEL' => Configuration::get('SMARTBANNER_CLOSE_LABEL'),
        ]);

        return $output . $this->renderForm();
    }

    public function renderForm()
    {
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

        return HelperForm::generateForm([$fields_form]);
    }

    public function hookHeader($params)
    {
        // Asigna la plantilla del smartbanner al header
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
                'enabled_platforms' => Configuration::get('SMARTBANNER_ENABLED_PLATFORMS'),
                'close_label' => Configuration::get('SMARTBANNER_CLOSE_LABEL'),
            ],
        ]);

        // Cargar CSS y JS
        $this->context->controller->registerStylesheet('module-smartbanner-css', 'modules/' . $this->name . '/views/css/smartbanner.css');
        $this->context->controller->registerJavascript('module-smartbanner-js', 'modules/' . $this->name . '/views/js/smartbanner.js');

        return $this->fetch('module:smartbanner/views/templates/front/smartbanner.tpl');
    }
}
