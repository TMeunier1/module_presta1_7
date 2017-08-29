<?php

class Blog extends Module
{
    public function __construct()
    {
        $this->name = 'blog';
        $this->tab = 'Happy_Blog';
        $this->version = '1.0.0';
        $this->author = 'Tibau Meunier';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Blog');
        $this->description = $this->l('Great blog.');

        $this->confirmUninstall = $this->l('Do you really want to uninstall that wonderful module ?');

        if (!Configuration::get('BLOG_NAME')) {
            $this->warning = $this->l('WTF where is the name? :(');
        }
    }

    public function installdb()
    {
        return Db::getInstance()->Execute('
        CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'post (
            `id_post` int(11) NOT NULL AUTO_INCREMENT,
            `title`  char(100) NOT NULL,
            `date_add` datetime NOT NULL,
            `body` text NOT NULL,
            PRIMARY KEY (`id_post`)
            ) ENGINE= '._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            ');
        }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        $parent_tab = new Tab();
        $parent_tab->name[$this->context->language->id] = $this->l('Blog');
        $parent_tab->class_name = 'AdminBlog';
        $parent_tab->id_parent = 0; // Home tab
        $parent_tab->module = $this->name;
        $parent_tab->add();

        if (!parent::install()
        || !$this->registerHook('leftColumn')
        || !$this->registerHook('header')
        || !$this->installdb()
        )
        {
            return false;
        }
        return true;
    }

    public function hookDisplayLeftColumn($params)
    {
        // $sql = new DbQuery();
        // $sql->select('*');
        // $sql->from('post');
        // $sql->build();
        // $sql->__toString();
        // $this->context->smarty->assign(
        //     array(
        //     'title' => $sql['title'],
        //     'date'  => $sql['date_add'],
        //     'desc'  => $sql['body']
        //     )
        // );
        // return Db::getInstance()->executeS($sql);
        // return $this->display(_PS_MODULE_DIR_."blog/blog.php", 'blog.tpl');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/blog.css', 'all');
    }

    public function hookDisplayRightColumn($params)
    {
        return $this->hookDisplayLeftColumn($params);
    }

    public function hookadmingc()
    {
        $this->smarty->assign(array(
        'zble' => 'zble'
        ));
        return $this->display(__FILE__, 'admin.tpl');
    }


    public function uninstalldb() {

        return Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'post');
    }

    public function uninstall(){
        $tab = new Tab((int)Tab::getIdFromClassName('AdminBlog'));
        $tab->delete();
        if (!parent::uninstall()
        || !$this->uninstalldb()
        ){
            return false;
        }
        else{
            return true;
        }
    }
}
