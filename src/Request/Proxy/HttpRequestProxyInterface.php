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
declare(strict_types = 1);

namespace Vainyl\Http\Request\Proxy;

use Vainyl\Http\Request\VainServerRequestInterface;

/**
 * Interface HttpRequestProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HttpRequestProxyInterface extends VainServerRequestInterface
{
    /**
     * @param VainServerRequestInterface $request
     *
     * @return HttpRequestProxyInterface
     */
    public function addRequest(VainServerRequestInterface $request) : HttpRequestProxyInterface;

    /**
     * @return VainServerRequestInterface
     */
    public function popRequest() : VainServerRequestInterface;

    /**
     * @return VainServerRequestInterface
     */
    public function getCurrentRequest() : VainServerRequestInterface;
}