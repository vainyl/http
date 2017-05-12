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

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpResponseProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseStackInterface extends ResponseInterface
{
    /**
     * @param ResponseInterface $vainResponse
     *
     * @return ResponseStackInterface
     */
    public function addResponse(ResponseInterface $vainResponse) : ResponseStackInterface;

    /**
     * @return ResponseInterface
     */
    public function popResponse() : ResponseInterface;

    /**
     * @return ResponseInterface
     */
    public function getCurrentResponse() : ResponseInterface;
}