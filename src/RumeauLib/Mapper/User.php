<?php
namespace RumeauLib\Mapper;

use ZfcUserDoctrineORM\Mapper\User as ZfcUserDoctrineORMMapper;

class User extends ZfcUserDoctrineORMMapper
{
    public function findByEmail($email)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(
            array(
                $this->options->getFieldNameEmail() => $email
            )
        );
    }

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
