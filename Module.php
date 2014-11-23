<?php
namespace RumeauLib;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\ModuleManager;

class Module implements AutoloaderProviderInterface
{
    public function init(ModuleManager $moduleManager)
    {
        $sm = $moduleManager->getEvent()->getParam('ServiceManager');
        $serviceListener = $sm->get('ServiceListener');
        $serviceListener->addServiceManager(
            'ModelManager',
            'model_manager',
            'RumeauLib\Model\ModelManagerProviderInterface',
            'getModelManagerConfig'
        );
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
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'zfcuser_module_options' => function ($serviceManager) {
                    $config = $serviceManager->get('Configuration');
                    return new Options\ZfcUserModuleOptions(isset($config['zfcuser']) ? $config['zfcuser'] : array());
                },
                'zfcuser_user_mapper' => function ($serviceManager) {
                    return new Mapper\User(
                        $serviceManager->get('zfcuser_doctrine_em'),
                        $serviceManager->get('zfcuser_module_options')
                    );
                },
            ),
        );
    }
}
