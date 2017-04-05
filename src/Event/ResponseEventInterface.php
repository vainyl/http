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
use Vainyl\Http\Response\VainResponseInterface;

/**
 * Interface ResponseEventInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ResponseEventInterface extends EventInterface
{
    /**
     * @return VainResponseInterface
     */
    public function getResponse() : VainResponseInterface;
}