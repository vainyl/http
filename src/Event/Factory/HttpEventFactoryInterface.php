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

namespace Vainyl\Http\Event\Factory;

use Vainyl\Http\Event\RequestEventInterface;
use Vainyl\Http\Event\ResponseEventInterface;
use Vainyl\Http\Request\VainServerRequestInterface;
use Vainyl\Http\Response\VainResponseInterface;

/**
 * Class HttpEventFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HttpEventFactoryInterface
{
    /**
     * @param VainServerRequestInterface $request
     *
     * @return RequestEventInterface
     */
    public function createRequestEvent(VainServerRequestInterface $request);

    /**
     * @param VainResponseInterface $response
     *
     * @return ResponseEventInterface
     */
    public function createResponseEvent(VainResponseInterface $response);
}