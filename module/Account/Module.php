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
    $app->getEventManager()->attach('dispatch', array($this, 'setLayout'), -90);
  }

  /**
   * @param MvcEvent $e
   */
  public function setLayout($e)
  {
    if (0 === strpos(__NAMESPACE__, 'Account', 0)){
      // Set the layout template
      $viewModel = $e->getViewModel();
      $viewModel->setTemplate('layout/index');
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