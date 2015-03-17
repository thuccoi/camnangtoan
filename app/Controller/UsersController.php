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
class UsersController extends AppController{
    //put your code here
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
        //$this->Auth->deny('admin_index','admin_add');
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
   
    public function initDB() {
        $group = $this->User->Group;

        // Allow admins to everything
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        // allow managers to posts and widgets
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts');
        $this->Acl->allow($group, 'controllers/Widgets');

        // allow users to only add and edit on posts and widgets
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Posts/edit');
        $this->Acl->allow($group, 'controllers/Widgets/add');
        $this->Acl->allow($group, 'controllers/Widgets/edit');

        // allow basic users to log out
        $this->Acl->allow($group, 'controllers/users/logout');

        // we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }

}
