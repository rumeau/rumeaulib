<?php
namespace RumeauLib\Options;

use ZfcUser\Options\ModuleOptions;

class ZfcUserModuleOptions extends ModuleOptions
{
    protected $fieldNameEmail = 'email';

    protected $fieldNameIdentity = 'identity';

    public function setFieldNameEmail($fieldNameEmail)
    {
        $this->fieldNameEmail = $fieldNameEmail;

        return $this;
    }

    public function getFieldNameEmail()
    {
        return $this->fieldNameEmail;
    }

    public function setFieldNameIdentity($fieldNameIdentity)
    {
        $this->fieldNameIdentity = $fieldNameIdentity;

        return $this;
    }

    public function getFieldNameIdentity()
    {
        return $this->fieldNameIdentity;
    }
}
