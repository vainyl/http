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
 * Class CannotSeekException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CannotSeekException extends AbstractStreamException
{
    private $position;

    /**
     * CannotSeekException constructor.
     *
     * @param StreamInterface $stream
     * @param int             $position
     */
    public function __construct(StreamInterface $stream, int $position)
    {
        $this->position = $position;
        parent::__construct($stream, sprintf('Cannot move cursor to position %d', $position));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['position' => $this->position], parent::toArray());
    }
}
