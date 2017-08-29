<?php
class blogdetailModuleFrontController extends ModuleFrontController
{

    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('detail.tpl');
        $this->context->smarty->assign("post", $this->get_post(Tools::getValue("id")));
    }

    public function get_post(int $id)
    {
        $posts = new DbQuery();
        $posts->select('*');
        $posts->from('post');
        $posts->where('id_post ='.$id);
        return Db::getInstance()->executeS($posts);

    }

}
