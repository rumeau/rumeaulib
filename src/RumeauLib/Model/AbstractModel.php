<?php
namespace RumeauLib\Model;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

/**
 * Class AbstractModel
 * @package RumeauLib\Model
 */
abstract class AbstractModel implements ModelInterface, ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

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
