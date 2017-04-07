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
 * Class ReadErrorException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CannotReadException extends AbstractStreamException
{
    private $length;

    /**
     * CannotReadException constructor.
     *
     * @param StreamInterface $stream
     * @param int             $length
     */
    public function __construct(StreamInterface $stream, int $length)
    {
        $this->length = $length;
        parent::__construct($stream, sprintf('Cannot read %d bytes from stream'));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['length' => $this->length], parent::toArray());
    }
}