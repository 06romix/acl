<?php
namespace Account\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Authentication\AuthenticationService;
use Account\Entity\User;

class AclPlugin extends AbstractPlugin
{
  private $userRole = 'guest';

  /**
   * AclPlugin constructor.
   */
  public function __construct() {
    $auth = new AuthenticationService();
    $this->userRole = ($auth->getIdentity()) ? User::getUserRole($auth->getIdentity()) : 'guest';
  }

  /**
   * @param string $action
   * @param null $privilege
   * @return bool
   */
  public function isAllowed($action, $privilege = null)
  {
    $resource = ($action == 'index') ? 'Account\Controller\Index' : $action;
    return (new MyAcl())->isAllowed($this->userRole, $resource, ($privilege == 'all') ? null : $privilege);
  }

  public function getUserRole()
  {
    return $this->userRole;
  }
}