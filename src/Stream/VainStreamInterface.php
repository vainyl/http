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

namespace Vainyl\Http\Stream;

use Psr\Http\Message\StreamInterface as HttpStreamInterface;

/**
 * Interface VainStreamInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface VainStreamInterface extends HttpStreamInterface
{
    /**
     * @return resource
     */
    public function getResource() : resource;
}