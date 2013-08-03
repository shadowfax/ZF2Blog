<?php
/**
 * Zend Framework 2 - Blog Module
 * 
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2005-2013 Juan Pedro Gonzalez Gutierrez
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


namespace Blog;

use Blog\Service\Blog;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
/*
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
*/
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
    
	public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Blog' =>  function($sm) {
        			$blog = new Blog();
        			$blog->setServiceManager($sm);
        			$blog->setAdapter($sm->get('Zend\Db\Adapter\Adapter'));
        			return $blog;
                },
                
            ),
        );
    }
}
