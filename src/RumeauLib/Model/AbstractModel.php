<?php
/**
 * Created by Jean Rumeau.
 * User: Jean
 * Date: 26/06/14
 * Time: 22:22
 *
 * @link
 * @copyright Copyright (c)
 * @license   http://opensource.org/licenses/MIT MIT License
 */
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

    const PAGINATOR_MAX_RESULTS = 25;

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
        if (is_array($entity)) {
            $entity = array_shift($entity);
        }

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
