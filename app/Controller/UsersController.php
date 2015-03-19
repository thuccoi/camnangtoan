<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author thuc
 */
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AppController{
    //put your code here
    var $uses=array('Mail','User');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->Auth->allow('createuser','login','logout','passmail','resetpass');
    }

    public function admin_index(){
        if ($this->Session->read('Auth.User')) {
            $user=$this->Session->read('Auth.User');
            $this->set(compact('user'));
        }
        else{
            return $this->redirect(array('action'=>'login'));
        }
    }
    public function admin_login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Session->read('Auth.User')) {
                    $this->Session->setFlash('You are logged in!');
                    return $this->redirect(array('action'=>'index'));
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Your username or password was incorrect.'));
        }
    }
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Session->read('Auth.User')) {
                    //$this->Session->setFlash('You are logged in!');
                    return $this->redirect(array('action'=>'index','controller'=>'posts'));
                }
            }
            $this->Session->setFlash(__('Your username or password was incorrect.'));
            return $this->redirect(array('action'=>'index','controller'=>'posts'));
        }
    }
    public function admin_logout() {
        //Leave empty for now.
        //$this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }
    public function logout() {
        //Leave empty for now.
        //$this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }
    public function passmail(){
        if($this->request->is('post')){
            $mail=$this->request->data['passmail']['mail'];
            $username=$this->request->data['passmail']['username'];
            if($this->User->findByEmail($mail)&&$this->User->findByUsername($username)){
                $user = $this->User->find('all', array(
                    'conditions' => array('User.email' => $mail)
                ));
                $cof=$this->Mail->find('all')[0]['Mail']['cofirm'];
                //thay doi thong tin mail
                $cof=str_replace("[name]",$user[0]['User']['firstname']." ".$user[0]['User']['lastname'],$cof);
                
                //luu ma thay doi repass vao databse
                $user[0]['User']['repass']=Tool::generateRandomString();
                $this->User->create();
                $this->User->save($user[0]);
                $cof=str_replace("[link]","http://localhost/camnangtoan/users/resetpass?user=".$username."&repass=".$user[0]['User']['repass'],$cof);
                $cof=str_replace("[username]",$username,$cof);
                
                $Email = new CakeEmail('gmail');
                $Email->from('camnangtoan@gmail.com');
                $Email->to($mail);
                $Email->subject('Cẩm nang toán học');
                $Email->send($cof);
                $this->Session->setFlash("Một hộp thư đã gửi tới mail của bạn, hãy vào mail để xác nhận.");
                return $this->redirect(array('action'=>'resetpass'));
            }else{
                $this->Session->setFlash("Email đăng ký hoặc tài khoản của bạn không chính xác.");
            }
        }
    }
    public function resetpass(){
        if(isset($_GET['repass'])&&isset($_GET['user'])){
            $user = $this->User->find('all', array(
                        'conditions' => array('User.username' => $_GET['user'])
                    ));
            if($user[0]['User']['repass']==$_GET['repass']&&$_GET['repass']!="not"){
                $mail=$user[0]['User']['email'];
                //thay doi noi dung
                $cof=$this->Mail->find('all')[0]['Mail']['modifi'];
                $pass=Tool::generateRandomString(8);
                $cof=str_replace("[pass]",$pass,$cof);
                $cof=str_replace("[name]",$user[0]['User']['firstname']." ".$user[0]['User']['lastname'],$cof);
                $cof=str_replace("[username]",$user[0]['User']['username'],$cof);
                //luu vao database
                $user[0]['User']['repass']="not";
                $user[0]['User']['password']=$pass;
                $this->User->create();
                $this->User->save($user[0]);
                $Email = new CakeEmail('gmail');
                $Email->from('camnangtoan@gmail.com');
                $Email->to($mail);
                $Email->subject('Cẩm nang toán học');
                $Email->send($cof);
                $this->Session->setFlash("Yêu cầu thay đổi mật khẩu chính xác. Mời bạn vào hộp thư mail để nhận mật khẩu mới của mình.");
                
            }else{
                $this->Session->setFlash("Yêu cầu thay đổi mật khẩu không chính xác.");
            }
        }  else {
            
        }
    }
    public function admin_mail() {
        $mail=$this->Mail->findById(1);
        if ($this->request->is('post')) {
            $this->Mail->create();
            $this->Mail->id=1;
            if ($this->Mail->save($this->request->data)) {
                $this->Session->setFlash(__('The mail has been saved'));
                return $this->redirect(array('action' => 'mail'));
            }
            $this->Session->setFlash(
                __('The mail could not be saved. Please, try again.')
            );
        }
         if (!$this->request->data) {
            $this->request->data = $mail;
        }
    }
    public function createuser() {
        if($this->request->is('post')){
            if(!isset($this->request->data['lang'])){
                $this->User->create();
                $this->User->save($this->request->data);
            }
        }
    }
}
