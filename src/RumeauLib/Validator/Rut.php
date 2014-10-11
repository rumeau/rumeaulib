<?php
/**
 * RumeauLib (https://github.com/rumeau/rumeaulib)
 *
 * @link      https://github.com/rumeau/rumeaulib for the canonical source repository
 * @copyright Copyright (c)
 * @license   http://opensource.org/licenses/MIT MIT License
 */
namespace RumeauLib\Validator;

use Zend\Validator\AbstractValidator;

/**
 * Class Rut
 * Validate a RUT
 *
 * @package RumeauLib\Validator
 */
class Rut extends AbstractValidator
{
    /**
     * Invalid minimum RUT
     */
    const RUT_MIN_INVALID = 'rutMinInvalid';
    /**
     * Invalid maximum RUT
     */
    const RUT_MAX_INVALID = 'rutMaxInvalid';
    /**
     * RUT format is invalid
     */
    const RUT_INVALID     = 'rutInvalid';

    /**
     * @var array Array of messages
     */
    protected $messageTemplates = array(
        self::RUT_MIN_INVALID => 'El RUT ingresado es menor que %min%',
        self::RUT_MAX_INVALID => 'El RUT ingresado es mayor que %max%',
        self::RUT_INVALID     => 'El RUT ingresado no es un RUT valido'
    );

    /**
     * Minimum value of RUT
     *
     * @var int
     */
    protected $min;

    /**
     * Maximum value of RUT
     *
     * @var int
     */
    protected $max;

    /**
     * Include min and max in validation
     *
     * @var boolean
     */
    protected $inclusive = false;

    /**
     * RUT Checksum characters
     *
     * @var array Array of valid checksums
     */
    protected $checksumChars = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 'k');

    /**
     * Get the minimum value
     *
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set the minimum value
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
     * Get the maximum value
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set the maximum value
     *
     * @param int $max
     *
     * @return Rut
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get inclusive comparison flag
     *
     * @return boolean
     */
    public function getInclusive()
    {
        return $this->inclusive;
    }

    /**
     * Set inclusive comparison flag
     *
     * @param boolean $inclusive
     *
     * @return Rut
     */
    public function setInclusive($inclusive)
    {
        $this->inclusive = (bool)$inclusive;

        return $this;
    }

    /**
     * Validates a RUT
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

        // Calculate Checksum
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
     * Validate min RUT value
     *
     * @param int $rut
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
     * Validate max RUT value
     *
     * @param int $rut
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
