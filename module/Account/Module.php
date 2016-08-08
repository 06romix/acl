<?php
namespace Account;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
  /**
   * @param MvcEvent $e
   */
  public function onBootstrap($e)
  {
    $eventManager        = $e->getApplication()->getEventManager();
    $moduleRouteListener = new ModuleRouteListener();
    $moduleRouteListener->attach($eventManager);

    $app = $e->getParam('application');
    $app->getEventManager()->attach('dispatch', array($this, 'setLayout'), 20);
  }

  /**
   * @param MvcEvent $e
   */
  public function setLayout($e)
  {
    $viewModel = $e->getViewModel();
    $viewModel->action = $e->getRouteMatch()->getParam('action');

    if (0 === strpos(__NAMESPACE__, 'Account', 0) || $viewModel->action == 'referral'){
      // Set the layout template
      $viewModel->setTemplate('layout/index');
    }

    if (in_array($viewModel->action, array('login', 'registration'), 0)){
      // Set the layout template
      $viewModel = $e->getViewModel();
      $viewModel->setTemplate('layout/auth');
      return;
    }
  }

  public function getConfig()
  {
    return include __DIR__ . '/config/module.config.php';
  }

  public function getAutoloaderConfig()
  {
    return array(
      'Zend\Loader\StandardAutoloader' => array(
        'namespaces' => array(
          __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
        ),
      ),
    );
  }
}