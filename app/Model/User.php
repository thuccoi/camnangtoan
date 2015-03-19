<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author thuc
 */
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $belongsTo = array('Group');
    public $actsAs = array('Acl' => array('type' => 'requester'));
    public function beforeSave($options = array()) {
        if(isset($this->data['User']['password'])){
                $this->data['User']['password'] = AuthComponent::password(
                $this->data['User']['password']);
        }
        return true;
    }
    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        }
        return array('Group' => array('id' => $groupId));
    }
    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }
    public $validate = array(
        'lastname' => array(
            'rule' => array('minLength', '2'),
            'message' => 'Phải nhập ít nhất 2 ký tự'
        ),
        'firstname' => array(
            'rule' => array('minLength', '1'),
            'message' => 'Phải nhập ít nhất 1 ký tự'
        ),
        'username' => array(
            'rule1' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Chỉ được nhập chữ hoặc số, không có ký tự đặc biệt',
                'last' => false
             ),
            'rule2' => array(
                'rule' => array('minLength', 8),
                'message' => 'Phải nhập ít nhất là 8 ký tự'
            )
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'message' => 'Mật khẩu phải ít nhất 8 ký tự'
        ),
        'password_cf' => array(
            'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Mật khẩu và mật khẩu xác nhận không trùng nhau',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'email' =>array(
            'rule'=>'email',
            'message'=>'Phải đúng định dạng email ví dụ camnangtoan@gmail.com'
        ),
        'email_cf' =>array(
            'email'=>array(
                'rule'=>'email',
                'message'=>'Phải đúng định dạng email ví dụ camnangtoan@gmail.com'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield','email'),
                'message' => 'Email xác nhận và email không trùng nhau',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'tel_num' => array(
            'rule1' => array(
                'rule' => 'numeric',
                'message' => 'Chỉ được nhập các chữ số',
                'last' => false
             ),
            'rule2' => array(
                'rule'    => array('Between', 9, 11),
                'message' => 'Số điện thoại phải từ 9 đến 11 chữ số'
            )
        )
    );
    function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    } 
}

