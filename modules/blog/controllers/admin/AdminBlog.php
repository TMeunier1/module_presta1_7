<?php

class AdminBlogController extends ModuleAdminController {

    public function __construct()
    {
        $this->table = 'post';
        $this->className = 'BlogPost';
        $this->context = Context::getContext();
        $this->bootstrap = true;
        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));
        $this->fields_list = array(
            'id_post' => array(
                'title' => $this->l('id'),
                'width' => 10,
                'type'  => 'int',
            ),
            'title' => array(
                'title' => $this->l('title'),
                'width' => 140,
                'type'  => 'text',
            ),
            'date_add' => array(
                'title' => $this->l('date'),
                'width'    => 140,
                'type'     => 'date',
            ),
            'body' => array(
                'title' => $this->l('body'),
                'width'    => 500,
                'type'     => 'text',
            ),
        );

        $this->fields_form = array(
            'legend' => array(
                'title'    => $this->l('post'),
            ),
            'input' => array(
                array(
                    'label' => $this->l('title'),
                    'type'  => 'text',
                    'name'  => 'title',
                ),
                array(
                    'label' => $this->l('date'),
                    'type' => 'date',
                    'name' => 'date_add',
                ),
                array(
                    'label' => $this->l('body'),
                    'type' => 'text',
                    'name' => 'body',
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
                )
            );
        parent::__construct();
    }
}
