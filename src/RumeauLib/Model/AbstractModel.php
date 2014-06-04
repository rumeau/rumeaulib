<?php
namespace RumeauLib\Model;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager;

abstract class AbstractModel implements ModelInterface, ObjectManagerAwareInterface
{
    use ProvidesObjectManager;

    /**
     * @var array
     */
    protected $messages = array();

    protected $entity;

    public function __construct($entity)
    {
        $this->setEntity($entity);

        return $this;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
