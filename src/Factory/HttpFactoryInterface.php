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
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface HttpFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HttpFactoryInterface extends IdentifiableInterface
{
    /**
     * @param array $server
     * @param array $serverRequest
     * @param array $query
     * @param array $body
     * @param array $files
     * @param array $cookies
     *
     * @return ServerRequestInterface
     */
    public function createRequest(
        array $server,
        array $serverRequest,
        array $query,
        array $body,
        array $files,
        array $cookies
    ): ServerRequestInterface;

    /**
     * @param int    $code
     * @param array  $headers
     * @param string $content
     *
     * @return ResponseInterface
     */
    public function createResponse(int $code = 200, array $headers, string $content): ResponseInterface;
}