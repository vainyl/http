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

namespace Vainyl\Http\Event\Handler;

use Vain\Core\Event\Handler\EventHandlerInterface;
use Vainyl\Http\Event\RequestEventInterface;

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