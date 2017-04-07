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
 * Class ResourceUnavailableException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class StreamUnavailableException extends AbstractStreamException
{
    /**
     * ResourceUnavailableException constructor.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, sprintf('Stream is unavailable'));
    }
}