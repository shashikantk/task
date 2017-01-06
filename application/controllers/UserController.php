<?php
/**
 * Created by PhpStorm.
 * User: shashikant.kuswaha
 * Date: 1/6/2017
 * Time: 4:50 PM
 */
class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $userdata = new Application_Model_UserMapper();
        //$this->addAction();
        $this->view->entries = $userdata->fetchAll();
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_UserDetails();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $userdata = new Application_Model_UserData($form->getValues());
                $mapper  = new Application_Model_UserMapper();
                $mapper->save($userdata);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}



