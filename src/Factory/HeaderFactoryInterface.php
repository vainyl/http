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

namespace Vainyl\Http\Factory;

use Vainyl\Http\HeaderInterface;

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
     * @return HeaderInterface
     */
    public function createHeader(string $name, $values) : HeaderInterface;
}