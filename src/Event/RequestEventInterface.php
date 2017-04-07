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

namespace Vainyl\Http\Event;

use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Event\EventInterface;

/**
 * Class RequestEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestEventInterface extends EventInterface
{
    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface;
}