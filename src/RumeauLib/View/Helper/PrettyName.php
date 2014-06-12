<?php
namespace RumeauLib\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;

/**
 * Class PrettyName
 * @package RumeauLib\View\Helper
 * @method string prettyname() prettyname(mixed $name, int $length = 1, bool $cutLast = true, string $termination = '.') Beautifies a user name
 */
class PrettyName extends AbstractHelper
{
    /**
     * @param mixed  $name
     * @param int    $length
     * @param bool   $cutLast
     * @param string $termination
     *
     * @return string
     * @throws \Zend\View\Exception\InvalidArgumentException
     */
    public function __invoke($name, $length = 1, $cutLast = true, $termination = '.')
    {
        if ($length < 1) {
            $length = 1;
        }

        if (is_string($name)) {
            $name = explode(' ', $name);
        }

        if (!is_array($name)) {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    'The name provided must be an array or a string, "%s" was provided',
                    gettype($name)
                )
            );
        }

        if ($length === 1) {
            $prettyName = $name[0];
        } else {
            if ($length > count($name)) {
                $length = count($name);
            }
            $name = array_slice($name, 0, $length);

            if ($cutLast) {
                $last = array_pop($name);
                $last = substr($last, 0, 1);
                $name[] = $last;
            }

            $prettyName = implode(' ', $name) . $termination;
        }

        return $prettyName;
    }
}
