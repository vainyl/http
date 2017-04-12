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

namespace Vainyl\Http\Event\Handler;

use Vainyl\Event\EventHandlerInterface;
use Vainyl\Http\Event\ResponseEventInterface;

/**
 * Interface ResponseEventHandlerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseEventHandlerInterface extends EventHandlerInterface
{
    /**
     * @param ResponseEventInterface $response
     *
     * @return ResponseEventHandlerInterface
     */
    public function response(ResponseEventInterface $response): ResponseEventHandlerInterface;
}