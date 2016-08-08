<?php
namespace Account\Plugin;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Authentication\AuthenticationService;
use Account\Entity\User;

class AclPlugin extends AbstractPlugin
{
  private $userRole;
  private $resource;
  private $acl;

  /**
   * AclPlugin constructor.
   */
  public function __construct() {
    $auth = new AuthenticationService();
    $this->acl = new MyAcl();
    $this->userRole = ($auth->hasIdentity()) ? User::getUserRole($auth->getIdentity()) : User::ROLE_GUEST;
  }

  public function init(AbstractActionController $controller)
  {
    $this->isAllowed($controller->params()->fromRoute('action'));
    if (!$this->isCanSee()) {
      $controller->redirect()->toRoute('account');
    }

    if (!$this->isAccess()) {
      $controller->layout()->setTemplate('layout/accessDenied');
    }
  }

  /**
   * @param string $action
   * @param null $privilege
   * @return bool
   */
  public function isAllowed($action, $privilege = null)
  {
    $this->resource = ($action == 'index') ? 'Account\Controller\Index' : $action;
    return $this->acl->isAllowed($this->userRole, $this->resource, ($privilege == 'all') ? null : $privilege);
  }

  public function isCanSee()
  {
    return $this->acl->isAllowed($this->userRole, $this->resource, 'see');
  }

  public function isAccess()
  {
    return $this->acl->isAllowed($this->userRole, $this->resource, 'access');
  }

  public function getUserRole()
  {
    return $this->userRole;
  }
}