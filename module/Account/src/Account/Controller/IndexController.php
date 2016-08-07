<?php
namespace Account\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
  public function indexAction()
  {
    $access = $this->AclPlugin()->isAllowed($this->params()->fromRoute('action'));
    var_dump($access);
    return new ViewModel();
  }

  public function dashboardAction()
  {
    $access = $this->AclPlugin()->isAllowed($this->params()->fromRoute('action'));
    var_dump($access);
    return new ViewModel(['action' => 'Dashboard']);
  }

  public function reportsAction()
  {
    $access = $this->AclPlugin()->isAllowed($this->params()->fromRoute('action'));
    var_dump($access);
    return new ViewModel();
  }

  public function configurationAction()
  {
    $access = $this->AclPlugin()->isAllowed($this->params()->fromRoute('action'));
    var_dump($access);
    return new ViewModel();
  }
}