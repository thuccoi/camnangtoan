<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailConfig
 *
 * @author theu
 */
class EmailConfig {
    public $gmail = array(
        'transport' => 'smtp',
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'camnangtoan@gmail.com',
        'password' => '2il4Bg05wn',
        'emailFormat'=>'both',
        'charset' => 'utf-8',
        'headerCharset' => 'utf-8',
    );
    
}
