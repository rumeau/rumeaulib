<?php
namespace RumeauLib\Options;

use ZfcUserDoctrineORM\Options\ModuleOptions;

/**
 * Class ZfcUserModuleOptions
 * @package RumeauLib\Options
 */
class ZfcUserModuleOptions extends ModuleOptions
{
    /**
     * @var string
     */
    protected $fieldNameEmail = 'email';

    /**
     * @var string
     */
    protected $fieldNameIdentity = 'identity';

    /**
     * @param $fieldNameEmail
     *
     * @return $this
     */
    public function setFieldNameEmail($fieldNameEmail)
    {
        $this->fieldNameEmail = $fieldNameEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldNameEmail()
    {
        return $this->fieldNameEmail;
    }

    /**
     * @param $fieldNameIdentity
     *
     * @return $this
     */
    public function setFieldNameIdentity($fieldNameIdentity)
    {
        $this->fieldNameIdentity = $fieldNameIdentity;

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldNameIdentity()
    {
        return $this->fieldNameIdentity;
    }
}
