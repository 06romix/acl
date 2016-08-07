<?php
namespace Account;

use Account\Controller\Plugin\AclPlugin;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Account\Entity\User;
use Zend\Authentication\AuthenticationService;
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
   * @return bool
   */
  public function AuthAndAcl($e)
  {
    $acl = new AclPlugin();
    $acl->isAllowed($e->getRouteMatch()->getParam('action'));
  }

  /**
   * @param MvcEvent $e
   */
  public function setLayout($e)
  {
    $viewModel = $e->getViewModel();
    $viewModel->action = $e->getRouteMatch()->getParam('action');

    if (0 === strpos(__NAMESPACE__, 'Account', 0)){
      // Set the layout template
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