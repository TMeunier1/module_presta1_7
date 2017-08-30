<?php
class MyModule extends Module
{
    public function __construct()
    {
        $this->name = 'mymodule';
        $this->tab = 'front_office_features';
        $this->version = '0.a';
        $this->author = 'Tibau Meunier';
        $this->need_instance = 0;
        $this->ps_version_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = 'My Module';
        $this->description = $this->l('This is a frigging decent module made with a lot of hate for prestashop');

        $this->confirmUninstall = $this->l('I won\'t blame you if you want to uninstall, i understand this module is fucked up !');

        if (!Configuration::get('MYMODULE_NAME'))
            $this->warning = $this->l('No name provided');
    }

    public function install()
    {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);

        if (!parent::install() ||
            !$this->registerHook('leftColumn') ||
            !$this->registerHook('header') ||
            !Configuration::updateValue('MYMODULE_NAME', 'my friend')
            )
            return false;

        return true;
    }

}
