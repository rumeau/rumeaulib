<?php
namespace RumeauLib\Mapper;

use ZfcUserDoctrineORM\Mapper\User as ZfcUserDoctrineORMMapper;

/**
 * Class User
 * @package RumeauLib\Mapper
 */
class User extends ZfcUserDoctrineORMMapper
{
    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(
            array(
                $this->options->getFieldNameEmail() => $email
            )
        );
    }

    /**
     * @param $username
     *
     * @return mixed
     */
    public function findByUsername($username)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(
            array(
                $this->options->getFieldNameIdentity() => $username
            )
        );
    }
}
