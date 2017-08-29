<?php

class BlogPost extends ObjectModel
{
    public $id_post;
    public $date_add;
    public $title;
    public $body;
    public static $definition = array(
        'table' => 'post',
        'primary' => 'id_post',
        'fields' => array(
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isString'),
            'title' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'body' => array('type' => self::TYPE_STRING, 'validate' => 'isString')
        ),
    );


}
