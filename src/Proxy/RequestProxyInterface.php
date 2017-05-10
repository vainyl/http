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

namespace Vainyl\Http\Proxy;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RequestProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestProxyInterface extends ServerRequestInterface
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return RequestProxyInterface
     */
    public function addRequest(ServerRequestInterface $request): RequestProxyInterface;

    /**
     * @return ServerRequestInterface
     */
    public function popRequest(): ServerRequestInterface;

    /**
     * @return ServerRequestInterface
     */
    public function getCurrentRequest(): ServerRequestInterface;
}