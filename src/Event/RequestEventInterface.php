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

use Vain\Core\Event\EventInterface;
use Vainyl\Http\Request\VainServerRequestInterface;

/**
 * Class RequestEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RequestEventInterface extends EventInterface
{
    /**
     * @return VainServerRequestInterface
     */
    public function getRequest() : VainServerRequestInterface;
}