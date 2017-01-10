<?php

class Application_Form_UserDetails extends Zend_Form
{

    public function init()
    {
        //set the form method to display to post
        $this->setMethod('post');

        //add username
        $this->addElement('text', 'name', array(
            'label'         => 'You Name:',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators' => array(array('Alpha'),
                array('validator' => 'StringLength', 'options' => array(0, 30))
            )
        ));

        //add email element
        $this->addElement('text', 'email', array(
            'label'         => 'You Email address:',
            'required'      => true,
            'filters'       => array('StringTrim'),
            'validators'    => array(
                    'EmailAddress',
            )
        ));

        //add country list
        $this->addElement('select', 'country', array(
            'label'        => 'Country (select):',
            'required'      => true,
            'onChange' => 'getState();'
            ));

        //add state list
        $this->addElement('select', 'state', array(
            'label'        => 'State (select):',
            'required'      => true,
            'multiOptions'=>array(
                '' => 'Select State',
            ),
        ));

        //add gender
        $this->addElement('radio', 'gender', array(
            'label'        => 'Gender:',
            'required'      => true,
            'multiOptions'=>array(
                'm' => 'Male',
                'f' => 'Female',
            ),
        ));

        //add hobbies multiselect
        $this->addElement('multiselect', 'hobbies', array(
            'label'      => 'Hobbies:',
            'required'   => true,
        ));

        //upload/add image
        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:')
            ->setRequired(true)
            ->setMaxFileSize(1024000) // limits the filesize on the client side
            ->setDescription('Click Browse and click on the image file you would like to upload')
            ->setDestination('../public/images/');
        $image->addValidator('Count', false, 1);                // ensure only 1 file
        $image->addValidator('Size', false, 1024000);            // limit to 10 meg
        $image->addValidator('Extension', false, 'jpg,jpeg,png,gif');// only JPEG, PNG, and GIFs
        $this->addElement($image);

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add User',
        ));

    }


}

