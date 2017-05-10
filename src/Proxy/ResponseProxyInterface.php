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

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpResponseProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseProxyInterface extends ResponseInterface
{
    /**
     * @param ResponseInterface $vainResponse
     *
     * @return ResponseProxyInterface
     */
    public function addResponse(ResponseInterface $vainResponse) : ResponseProxyInterface;

    /**
     * @return ResponseInterface
     */
    public function popResponse() : ResponseInterface;

    /**
     * @return ResponseInterface
     */
    public function getCurrentResponse() : ResponseInterface;
}