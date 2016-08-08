<?php
namespace Auth\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
  public function __construct($name = null)
  {
    parent::__construct('authForm');
    $this->setAttribute('method', 'post');
    $this->setAttribute('class', 'form-horizontal');

    $this->add(array(
      'name' => 'name',
      'type' => 'Text',
      'options' => array(
        'min' => 2,
        'max' => 100,
        'label' => 'Login',
      ),
      'attributes' => array(
        'class' => 'form-control',
        'required' => 'required',
      ),
    ));

    $this->add(array(
      'name' => 'pass',
      'type' => 'password',
      'options' => array(
        'min' => 3,
        'max' => 500,
        'label' => 'Password',
      ),
      'attributes' => array(
        'class' => 'form-control',
        'required' => 'required',
      ),
    ));

    $this->add(array(
      'name' => 'submit',
      'type' => 'submit',
      'attributes' => array(
        'value' => 'Log in',
        'id' => 'btmSubmit',
        'class' => 'btn btnSubmit',
      ),
    ));
  }
}