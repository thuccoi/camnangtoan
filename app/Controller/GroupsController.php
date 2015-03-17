<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupsController
 *
 * @author thuc
 */
class GroupsController extends AppController{
    //put your code here
    public function beforeFilter() {
        parent::beforeFilter();
        // For CakePHP 2.1 and up
       // $this->Auth->allow();
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The Group has been saved'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(
                __('The Group could not be saved. Please, try again.')
            );
        }
    }
}
