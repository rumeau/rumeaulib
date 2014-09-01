<?php
/**
 * RumeauLib (https://github.com/rumeau/rumeaulib)
 *
 * @link      https://github.com/rumeau/rumeaulib for the canonical source repository
 * @copyright Copyright (c)
 * @license   http://opensource.org/licenses/MIT MIT License
 */
namespace RumeauLib\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class PrettyName
 * Beautifies a user name
 *
 * @package RumeauLib\View\Helper
 * @method string prettyname() prettyname(mixed $name, int $length = 1, bool $cutLast = true, string $termination = '.') Beautifies a user name
 * @method PhpRenderer getView()
 */
class PrettyName extends AbstractHelper
{
    /**
     * Display a user name in a formatted output
     *
     * @param array|string $name The user name as an array of parts or as a full string
     * @param int    $length Number of parts to concatenate the user name. Default: 1
     * @param bool   $cutLast Should the last part displayed be abbreviated. Default: true
     * @param string $termination How to end the concatenation. Default: '.' (dot)
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

        array_walk($name, array($this->getView()->plugin('escapehtml'), '__invoke'));
        $name = array_filter($name);

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
