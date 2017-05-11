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

namespace Vainyl\Http\Stack;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RequestProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestStackInterface extends ServerRequestInterface
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return RequestStackInterface
     */
    public function addRequest(ServerRequestInterface $request): RequestStackInterface;

    /**
     * @return ServerRequestInterface
     */
    public function popRequest(): ServerRequestInterface;

    /**
     * @return ServerRequestInterface
     */
    public function getCurrentRequest(): ServerRequestInterface;
}