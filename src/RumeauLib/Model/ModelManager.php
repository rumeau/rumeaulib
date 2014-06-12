<?php
namespace RumeauLib\Model;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\InitializableInterface;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

/**
 * Plugin manager implementation for entity models.
 */
class ModelManager extends AbstractPluginManager
{
    /**
     * Don't share form elements by default
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * @param ConfigInterface $configuration
     */
    public function __construct(ConfigInterface $configuration = null)
    {
        parent::__construct($configuration);

        $this->addInitializer(array($this, 'injectObjectManager'));
    }

    /**
     * Inject the objectManager to any element that implements ObjectManagerAwareInterface
     *
     * @param $model
     */
    public function injectObjectManager($model)
    {
        if ($model instanceof ObjectManagerAwareInterface) {
            if ($this->serviceLocator instanceof ServiceLocatorInterface
                && $this->serviceLocator->has('RumeauLib\EntityManager\Default')
            ) {
                $objectManager = $this->serviceLocator->get('RumeauLib\EntityManager\Default');
                $model->setObjectManager($objectManager);
            }
        }
    }

    /**
     * Validate the plugin
     *
     * Checks that the element is an instance of ElementInterface
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
        
        return;
    }
}
