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

/**
 * Interface ResponseFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseFactoryInterface
{
    /**
     * @param string $destinationStream
     * @param int    $statusCode
     * @param array  $headersData
     * @param string $content
     *
     * @return ResponseInterface
     */
    public function createResponse(
        string $destinationStream,
        int $statusCode = 200,
        array $headersData = [],
        string $content = ''
    ): ResponseInterface;
}