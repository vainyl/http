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

use Psr\Http\Message\UriInterface;

/**
 * Interface UriFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface UriFactoryInterface
{
    /**
     * @param string $uri
     *
     * @return UriInterface
     */
    public function createUri(string $uri) : UriInterface;
}