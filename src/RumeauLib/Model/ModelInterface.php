<?php
namespace RumeauLib\Model;

/**
 * Interface ModelInterface
 * @package RumeauLib\Model
 */
interface ModelInterface
{
    /**
     * @param $entity
     *
     * @return mixed
     */
    public function setEntity($entity);

    /**
     * @return mixed
     */
    public function getEntity();
}
