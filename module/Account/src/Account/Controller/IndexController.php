<?php
namespace Account\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;

class IndexController extends AbstractActionController
{
  /**
   * @param MvcEvent $e
   * @return mixed
   */
  public function onDispatch(MvcEvent $e) {
    $this->AclPlugin()->init($this);
    return parent::onDispatch($e);
  }

  public function indexAction()
  {
    return new ViewModel();
  }

  public function dashboardAction()
  {
    return new ViewModel();
  }

  public function reportsAction()
  {
    return new ViewModel();
  }

  public function configurationAction()
  {
    return new ViewModel();
  }
}
