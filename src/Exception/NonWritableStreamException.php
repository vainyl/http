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

namespace Vainyl\Http\Exception;

use Psr\Http\Message\StreamInterface;

/**
 * Class NonWritableStreamException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NonWritableStreamException extends AbstractStreamException
{
    /**
     * NonWritableStreamException constructor.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, sprintf('Stream is non-writable'));
    }
}