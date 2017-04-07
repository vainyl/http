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
 * Class CursorUnavailableException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CursorUnavailableException extends AbstractStreamException
{
    /**
     * CursorUnavailableException constructor.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        parent::__construct($stream, sprintf('Cannot determine current cursor position'));
    }
}