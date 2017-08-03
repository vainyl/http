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

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface RequestFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string       $method
     * @param UriInterface $uri
     *
     * @return RequestInterface
     */
    public function createRequest(string $method, UriInterface $uri): RequestInterface;

    /**
     * @param string       $method
     * @param UriInterface $uri
     *
     * @return ServerRequestInterface
     */
    public function createServerRequest(string $method, UriInterface $uri): ServerRequestInterface;

    /**
     * @param array $requestData
     *
     * @return ServerRequestInterface
     */
    public function create(array $requestData): ServerRequestInterface;
}