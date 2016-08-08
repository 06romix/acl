<?php
namespace Auth\Form;

use Zend\Form\Form;

class RegistrationForm extends Form
{
  public function __construct($name = null)
  {
    parent::__construct('registrationForm');
    $this->setAttribute('method', 'post');
    $this->setAttribute('class', 'form-horizontal');
    $this->setAttribute('id', 'formR');

    $this->add(array(
      'name' => 'name',
      'type' => 'Text',
      'options' => array(
        'label' => 'Login',
      ),
      'attributes' => array(
        'class' => 'form-control',
        'required' => 'required',
      ),
    ));

    $this->add(array(
      'name' => 'email',
      'type' => 'Text',
      'options' => array(
        'label' => 'E-mail',
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
        'label' => 'Password',
      ),
      'attributes' => array(
        'class' => 'form-control',
        'required' => 'required',
        'id' => 'password',
      ),
    ));

    $this->add(array(
      'name' => 'rePass',
      'type' => 'password',
      'options' => array(
        'label' => 'Confirm password',
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
        'value' => 'Registration',
        'id' => 'btmSubmit',
        'class' => 'btn btnSubmit',
      ),
    ));
  }
}