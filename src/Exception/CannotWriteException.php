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
 * Class WriteErrorException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CannotWriteException extends AbstractStreamException
{
    private $data;

    /**
     * CannotWriteException constructor.
     *
     * @param StreamInterface $stream
     * @param string          $data
     */
    public function __construct(StreamInterface $stream, string $data)
    {
        $this->data = $data;
        parent::__construct($stream, sprintf('Cannot write data %s to stream', $data));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['data' => $this->data], parent::toArray());
    }
}