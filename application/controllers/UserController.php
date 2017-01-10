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
        $this->view->entries = $userdata->fetchAll();
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_UserDetails();
        $countrydata = new Application_Model_CountryMapper();
        $countrieslist = array(''=>'Select Country');

        foreach($countrydata->fetchAll() as $val) {
            $countrieslist[$val->id]=$val->country;
        }

        $form->getElement('country')->setMultiOptions($countrieslist);
        $hobbiesdata = new Application_Model_HobbiesMapper();
        $hobbieslist = array();

        foreach($hobbiesdata->fetchAll() as $val) {
            $hobbieslist[$val->id]=$val->hobbies;
        }

        $form->getElement('hobbies')->setMultiOptions($hobbieslist);

        if ($this->getRequest()->isPost()) {
            $form->getElement('state')->setRegisterInArrayValidator(false);
            if ($form->isValid($request->getPost())) {
                $userdata = new Application_Model_UserData($form->getValues());
                $mapper  = new Application_Model_UserMapper();
                $mapper->save($userdata);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function stateAction()
    {
        $request = $this->getRequest();
        $objstatelist = new Application_Model_StateMapper();
        $countryId=$request->getParam('countryId');
        $states=$objstatelist->fetchAll($countryId);
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        echo $this->_helper->json($states);
        exit;
    }
}



