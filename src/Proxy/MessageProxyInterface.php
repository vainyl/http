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

namespace Vainyl\Http\Proxy;

use Psr\Http\Message\MessageInterface;

/**
 * Interface MessageProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface MessageProxyInterface extends MessageInterface
{
    /**
     * @param MessageInterface $message
     *
     * @return MessageProxyInterface
     */
    public function addMessage(MessageInterface $message) : MessageProxyInterface;

    /**
     * @return MessageInterface
     */
    public function popMessage() : MessageInterface;

    /**
     * @inheritDoc
     */
    public function getCurrentMessage() : MessageInterface;
}