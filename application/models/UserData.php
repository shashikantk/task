<?php
/**
 * Created by PhpStorm.
 * User: shashikant.kuswaha
 * Date: 1/6/2017
 * Time: 5:10 PM
 */
// application/models/UserData.php

class Application_Model_UserData
{
    protected $_name;
    protected $_email;
    protected $_gender;
    protected $_country;
    protected $_state;
    protected $_hobbies;
    protected $_image;
    protected $_id;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid userdata property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid userdata property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setName($text)
    {
        $this->_name = (string) $text;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setGender($gender)
    {
        $this->_gender = $gender;
        return $this;
    }

    public function getGender()
    {
        return $this->_gender;
    }

    public function setCountry($country)
    {
        $this->_country = $country;
        return $this;
    }

    public function getCountry()
    {
        return $this->_country;
    }

    public function setState($state)
    {
        $this->_state = $state;
        return $this;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function setHobbies($hobbies)
    {
        $this->_hobbies = is_array($hobbies)?implode(",",$hobbies):explode(",",$hobbies);
        return $this;
    }

    public function getHobbies()
    {
        return $this->_hobbies;
    }

    public function setImage($image)
    {
        $this->_image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}