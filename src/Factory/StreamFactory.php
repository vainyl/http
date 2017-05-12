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
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Http\ResourceStream;
use Vainyl\Http\StringStream;

/**
 * Class StreamFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class StreamFactory extends AbstractIdentifiable implements StreamFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createStream(string $content = ''): StreamInterface
    {
        return new StringStream($content);
    }

    /**
     * @inheritDoc
     */
    public function createResource($resource): StreamInterface
    {
        return new ResourceStream($resource);
    }
}