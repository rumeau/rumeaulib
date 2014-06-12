<?php
namespace RumeauLib\Model\Service;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\InitializableInterface;
use RumeauLib\Model\ModelManager;
use RumeauLib\Model\ModelInterface;
use RumeauLib\Model\Exception;

class ModelManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'RumeauLib\Model\ModelManager';

    /**
     * Create and return the MVC controller plugin manager
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ModelManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $plugins = parent::createService($serviceLocator);
        $plugins->addPeeringServiceManager($serviceLocator);
        $plugins->setRetrieveFromPeeringManagerFirst(true);
        
        return $plugins;
    }
    
    /**
     * Validate the plugin
     *
     * Checks that the element is an instance of ModelInterface
     *
     * @param  mixed $plugin
     * @throws Exception\InvalidModelException
     * @return void
     */
    public function validatePlugin($plugin)
    {
        // Hook to perform various initialization, when the element is not created through the factory
        if ($plugin instanceof InitializableInterface) {
            $plugin->init();
        }
        
        if ($plugin instanceof ModelInterface) {
            return; // we're okay
        }
        
        throw new Exception\InvalidModelException(sprintf(
            'Plugin of type %s is invalid; must implement RumeauLib\Model\ModelInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}
