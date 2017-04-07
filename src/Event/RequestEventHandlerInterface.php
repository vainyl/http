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

namespace Vainyl\Http\Event;

use Vainyl\Event\EventHandlerInterface;

/**
 * Interface RequestEventHandlerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestEventHandlerInterface extends EventHandlerInterface
{
    /**
     * @param RequestEventInterface $event
     *
     * @return RequestEventHandlerInterface
     */
    public function request(RequestEventInterface $event) : RequestEventHandlerInterface;
}