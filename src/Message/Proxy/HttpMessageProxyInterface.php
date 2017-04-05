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

namespace Vainyl\Http\Message\Proxy;

use Vainyl\Http\Message\VainMessageInterface;

/**
 * Interface HttpMessageProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HttpMessageProxyInterface extends VainMessageInterface
{
    /**
     * @param VainMessageInterface $message
     *
     * @return HttpMessageProxyInterface
     */
    public function addMessage(VainMessageInterface $message);

    /**
     * @return VainMessageInterface
     */
    public function popMessage();

    /**
     * @return VainMessageInterface
     */
    public function getCurrentMessage();
}