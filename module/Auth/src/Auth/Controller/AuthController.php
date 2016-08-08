<?php
namespace Auth\Controller;

use Auth\Form\MyRegistrationFilter;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;

use Auth\AuthModel\MyAuthAdapter;
use Auth\Form\LoginForm;
use Auth\Form\RegistrationForm;
use Auth\Form\ReferralForm;
use Account\Entity\User;
use Zend\Mvc\MvcEvent;
class AuthController extends AbstractActionController
{
//  /**
//   * @param MvcEvent $e
//   * @return mixed
//   */
//  public function onDispatch(MvcEvent $e) {
//    $this->AclPlugin()->init($this);
//    return parent::onDispatch($e);
//  }

  public function loginAction()
  {
    $form = new LoginForm;
    $auth = new AuthenticationService();

    if ($auth->hasIdentity()) {
      // Identity exists
      return $this->redirect()->toRoute('account');
    }

    /**
     * @var $request Request
     */
    $request = $this->getRequest();
    if ($request->isPost()){
      $form->setData($request->getPost());
      if ($form->isValid()){
        $userData = $form->getData();

        //Authentication
        $authAdapter = new MyAuthAdapter($userData['name'], md5($userData['pass']));
        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()){
          return $this->redirect()->toRoute('account');
        } else {
          $status = 'error';
          $message = 'Невірний логін або пароль';
            $this->flashMessenger()
              ->setNamespace($status)
              ->addMessage($message);
          return $this->redirect()->refresh();
        }
      }
    }
    return array('form' => $form);
  }

  public function registrationAction()
  {
    $form = new RegistrationForm();
    $auth = new AuthenticationService();
    $status = $message = '';

    if ($auth->hasIdentity()) {
      // Identity exists
      return $this->redirect()->toRoute('account');
    }

    /**
     * @var $request Request
     */
    $request = $this->getRequest();
    if ($request->isPost()){

      $filters = new MyRegistrationFilter();
      $form->setInputFilter($filters->getInputFilter());

      $form->setData($request->getPost());
      if ($form->isValid()){

        //add user
        $userData = $form->getData();
        $user = new User();
        $user->exchangeArray($form->getData());
        $user->createUser();

        //Authentication
        $authAdapter = new MyAuthAdapter($userData['name'], md5($userData['pass']));
        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()) {
          $status = 'success';
          $message = 'Реєстрація пройшла успішно';
          if ($message){
            $this->flashMessenger()
              ->setNamespace($status)
              ->addMessage($message);
          }
          return $this->redirect()->toRoute('account');
        } else {
          $status = 'error';
          $message = 'Something went wrong';
        }

      } else {
        $status = 'error';
        $message = 'Parameters error';
      }
    }

    //make message
    if ($message){
      $this->flashMessenger()
        ->setNamespace($status)
        ->addMessage($message);
    }

    return array('form' => $form);
  }

  public function referralAction()
  {
    $form = new ReferralForm();
    $auth = new AuthenticationService();
    $status = $message = '';

    if (!$auth->hasIdentity()) {
      // Identity exists
      return $this->redirect()->toRoute('account');
    }

    /**
     * @var $request Request
     */
    $request = $this->getRequest();
    if ($request->isPost()) {

      $filters = new MyRegistrationFilter();
      $form->setInputFilter($filters->getInputFilter());

      $form->setData($request->getPost());
      if ($form->isValid()) {
        //add referral
        $userData = $form->getData();
        $user = new User();
        $user->exchangeArray($form->getData());
        $user->addReferral($auth->getIdentity());

        //Authentication
        $authAdapter = new MyAuthAdapter($userData['name'], md5($userData['pass']));
        $result = $authAdapter->authenticate();

        if ($result->isValid()) {
          $status = 'success';
          $message = 'Referral successfully added';
          if ($message){
            $this->flashMessenger()
              ->setNamespace($status)
              ->addMessage($message);
          }
          return $this->redirect()->toRoute('account');
        } else {
          $status = 'error';
          $message = 'Something went wrong';
        }

      } else {
        $status = 'error';
        $message = 'Parameters error';
      }
    }

    //make message
    if ($message){
      $this->flashMessenger()
        ->setNamespace($status)
        ->addMessage($message);
    }

    return array('form' => $form);
  }

  public function logoutAction()
  {
    (new AuthenticationService())->clearIdentity();
    session_unset();
    session_destroy();
    return $this->redirect()->toRoute('account');
  }
}