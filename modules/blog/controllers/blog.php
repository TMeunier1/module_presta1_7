<?php
class blogDisplayModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        global $smarty;
        parent::initContent();
        $this->setTemplate('display.tpl');
    }
}
