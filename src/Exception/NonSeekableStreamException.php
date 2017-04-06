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
 * Class NonSeekableStreamException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class NonSeekableStreamException extends AbstractStreamException
{
    /**
     * ResourceUnavailableException constructor.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, sprintf('Stream is non-seekable'));
    }
}