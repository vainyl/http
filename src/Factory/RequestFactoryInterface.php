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

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface RequestFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestFactoryInterface
{
    const PARSE_URL_SCHEME = 'scheme';
    const PARSE_URL_HOST = 'host';
    const PARSE_URL_PORT = 'port';
    const PARSE_URL_USER = 'user';
    const PARSE_URL_PASS = 'pass';
    const PARSE_URL_PATH = 'path';
    const PARSE_URL_QUERY = 'query';
    const PARSE_URL_FRAGMENT = 'fragment';

    /**
     * @return ServerRequestInterface
     */
    public function createFromGlobals();

    /**
     * @param array           $serverParams
     * @param array           $uploadedFiles
     * @param array           $queryParams
     * @param array           $attributes
     * @param array           $parsedBody
     * @param string          $protocol
     * @param string          $method
     * @param UriInterface    $uri
     * @param StreamInterface $stream
     * @param array           $cookies
     * @param array           $headers
     *
     * @return ServerRequestInterface
     */
    public function createRequest(
        array $serverParams,
        array $uploadedFiles,
        array $queryParams,
        array $attributes,
        array $parsedBody,
        string $protocol,
        string $method,
        UriInterface $uri,
        StreamInterface $stream,
        array $cookies,
        array $headers
    ): ServerRequestInterface;
}