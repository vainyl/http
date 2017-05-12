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
declare(strict_types=1);

namespace Vainyl\Http\Factory;

use Psr\Http\Message\StreamInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface StreamFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface StreamFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $content
     *
     * @return StreamInterface
     */
    public function createStream(string $content = '') : StreamInterface;

    /**
     * @param resource $resource
     *
     * @return StreamInterface
     */
    public function createResource($resource): StreamInterface;
}