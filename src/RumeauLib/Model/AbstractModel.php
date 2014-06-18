<?php
namespace RumeauLib\Model;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Stdlib\InitializableInterface;

/**
 * Class AbstractModel
 * @package RumeauLib\Model
 */
abstract class AbstractModel implements ModelInterface,
    ObjectManagerAwareInterface,
    ServiceLocatorAwareInterface,
    InitializableInterface
{
    use ProvidesObjectManager;
    use ServiceLocatorAwareTrait;

    /**
     * @var array
     */
    protected $messages = array();

    /**
     * @var
     */
    protected $entity;

    /**
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->setEntity($entity);

        return $this;
    }

    /**
     *
     */
    public function init()
    {
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param $entity
     *
     * @return $this
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
