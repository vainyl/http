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

namespace Vainyl\Http\Response\Proxy;

use Vainyl\Http\Response\VainResponseInterface;

/**
 * Interface HttpResponseProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HttpResponseProxyInterface extends VainResponseInterface
{
    /**
     * @param VainResponseInterface $vainResponse
     *
     * @return HttpResponseProxyInterface
     */
    public function addResponse(VainResponseInterface $vainResponse);

    /**
     * @return VainResponseInterface
     */
    public function popResponse();

    /**
     * @return VainResponseInterface
     */
    public function getCurrentResponse();
}