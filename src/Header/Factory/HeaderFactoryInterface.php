<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);

namespace Vainyl\Http\Header\Factory;

use Vainyl\Http\Header\VainHeaderInterface;

/**
 * Interface HeaderFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HeaderFactoryInterface
{
    /**
     * @param string $name
     * @param mixed  $values
     *
     * @return VainHeaderInterface
     */
    public function createHeader(string $name, $values) : VainHeaderInterface;
}