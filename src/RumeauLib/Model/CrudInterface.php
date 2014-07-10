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

use Zend\Form\FormInterface;

/**
 * Interface CrudInterface
 * @package Crm\Model
 */
interface CrudInterface
{
    /**
     * @param FormInterface $form
     * @param array         $data
     *
     * @return mixed
     */
    public function create(FormInterface $form, $data = array());

    /**
     * @return mixed
     */
    public function retrieve();

    /**
     * @param FormInterface $form
     * @param array         $data
     *
     * @return mixed
     */
    public function update(FormInterface $form, $data = array());

    /**
     * @param               $entity
     * @param FormInterface $form
     * @param array         $data
     *
     * @return mixed
     */
    public function delete($entity, FormInterface $form, $data = array());
}
