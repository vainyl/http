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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Interface ResponseFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseFactoryInterface
{
    /**
     * @param int             $statusCode
     * @param StreamInterface $stream
     * @param \ArrayAccess    $headers
     *
     * @return ResponseInterface
     */
    public function createResponse(
        int $statusCode,
        StreamInterface $stream,
        \ArrayAccess $headers
    ): ResponseInterface;
}