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
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractStreamException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractStreamException extends AbstractCoreException implements StreamExceptionInterface
{
    private $stream;

    /**
     * AbstractStreamException constructor.
     *
     * @param StreamInterface $stream
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct(StreamInterface $stream, string $message, int $code = 500, \Exception $previous = null)
    {
        $this->stream = $stream;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getStream(): StreamInterface
    {
        return $this->stream;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['string' => $this->stream->__toString()], parent::toArray());
    }
}