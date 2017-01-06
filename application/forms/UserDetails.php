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
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 40))
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
            'value'        => 'blue',
            'multiOptions' => array(
                'red'    => 'Rouge',
                'blue'   => 'Bleu',
                'white'  => 'Blanc',
            ),
        ));

        //add state list
        $this->addElement('select', 'state', array(
            'label'        => 'State (select):',
            'value'        => 'blue',
            'multiOptions' => array(
                'red'    => 'Rouge',
                'blue'   => 'Bleu',
                'white'  => 'Blanc',
            ),
        ));

        //add country list
        $this->addElement('radio', 'gender', array(
            'label'        => 'Gender:',
            'multiOptions'=>array(
                'male' => 'Male',
                'female' => 'Female',
            ),
        ));

        //add hobbies multiselect
        $this->addElement('multiselect', 'hobbies', array(
            'label'      => 'Hobbies:',
            'required'   => true,
        ));

        $this->getElement('hobbies')->setMultiOptions(array(
            //'option value' => 'option label'
            '1' => 'play',
            '2' => 'dance',
            '3' => 'cricket'
        ));

        //upload/add image
        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:')
            ->setRequired(true)
            ->setMaxFileSize(1024000) // limits the filesize on the client side
            ->setDescription('Click Browse and click on the image file you would like to upload');
        $image->addValidator('Count', false, 1);                // ensure only 1 file
        $image->addValidator('Size', false, 1024000);            // limit to 10 meg
        $image->addValidator('Extension', false, 'jpg,jpeg,png,gif');// only JPEG, PNG, and GIFs
        $this->addElement($image);

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Add User',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

    }


}

