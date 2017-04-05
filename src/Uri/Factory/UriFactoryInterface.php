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

namespace Vainyl\Http\Uri\Factory;

use Vainyl\Http\Uri\VainUriInterface;

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
     * @return VainUriInterface
     */
    public function createUri(string $uri) : VainUriInterface;
}