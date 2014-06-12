<?php
namespace RumeauLib\Validator;

use Zend\Validator\AbstractValidator;

class Rut extends AbstractValidator
{
    const RUT_MIN_INVALID = 'rutMinInvalid';
    const RUT_MAX_INVALID = 'rutMaxInvalid';
    const RUT_INVALID     = 'rutInvalid';

    /**
     * @var array
     */
    protected $messageTemplates = array(
        self::RUT_MIN_INVALID => 'El RUT ingresado es menor que %min%',
        self::RUT_MAX_INVALID => 'El RUT ingresado es mayor que %max%',
        self::RUT_INVALID     => 'El RUT ingresado no es un URT valido'
    );

    /**
     * Valor minimo del RUT
     *
     * @var int
     */
    protected $min = false;

    /**
     * Valor maximo del RUT
     *
     * @var int
     */
    protected $max = false;

    /**
     * Validar que el minimo y maximo sean inclusivos
     *
     * @var boolean
     */
    protected $inclusive = false;

    /**
     * @var array
     */
    protected $checksumChars = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 'k');

    /**
     * Establece el valor minimo del rut
     *
     * @param  int $min
     *
     * @return Rut
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Obtiene el valor minimo del rut
     *
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Establece el valor maximo del rut
     *
     * @param int
     *
     * @return Rut
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Obtiene el valor maximo del rut
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Establece la comparasion inclusiva
     *
     * @param boolean
     *
     * @return Rut
     */
    public function setInclusive($inclusive)
    {
        $this->inclusive = (bool)$inclusive;

        return $this;
    }

    /**
     * Obtiene el tipo de comparasion
     *
     * @return boolean
     */
    public function getInclusive()
    {
        return $this->inclusive;
    }

    /**
     * Valida un RUT
     *
     * @param string $value
     *
     * @return boolean
     */
    public function isValid($value)
    {
        $value = strtoupper($value);
        $this->setValue($value);

        $rut = substr($value, 0, -1);
        $rut = (int)$rut;
        $dv  = substr($value, -1);

        if (!$this->checkMin($rut)) {
            $this->error(self::RUT_MIN_INVALID);

            return false;
        }

        if (!$this->checkMax($rut)) {
            $this->error(self::RUT_MAX_INVALID);

            return false;
        }

        if (!in_array($dv, $this->checksumChars)) {
            $this->error(self::RUT_INVALID);

            return false;
        }

        // Calcular DV
        $d = 1;
        for ($x = 0; $rut != 0; $rut /= 10) {
            $d = ($d + $rut % 10 * (9 - $x++ % 6)) % 11;
        }

        $calcDv = chr($d ? $d + 47 : 75);
        if ($calcDv != $dv) {
            $this->error(self::RUT_INVALID);

            return false;
        }

        return true;
    }

    /**
     * Valida que el RUT no sea menor que el minimo
     *
     * @param int
     *
     * @return boolean
     */
    public function checkMin($rut)
    {
        if (!$this->min) {
            return true;
        }

        if ($this->inclusive) {
            if ($this->min > $rut) {
                return false;
            }
        } else {
            if ($this->min >= $rut) {
                return false;
            }
        }

        return true;
    }

    /**
     * Valida que el RUT no sea mayor que el maximo
     *
     * @param int
     *
     * @return boolean
     */
    public function checkMax($rut)
    {
        if (!$this->max) {
            return true;
        }

        if ($this->inclusive) {
            if ($rut > $this->max) {
                return false;
            }
        } else {
            if ($rut >= $this->max) {
                return false;
            }
        }

        return true;
    }
}
