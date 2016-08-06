<?php
namespace Account\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
  public function indexAction()
  {
    return new ViewModel();
  }

  public function dashboardAction()
  {
    $this->layout()->action = 'd';
    return new ViewModel(['action' => 'Dashboard']);
  }

  public function reportsAction()
  {
    $this->layout()->action = 'r';
    return new ViewModel();
  }

  public function configurationAction()
  {
    $this->layout()->action = 'c';
    return new ViewModel();
  }
}