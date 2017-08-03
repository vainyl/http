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

use Psr\Http\Message\MessageInterface;

/**
 * Interface MessageProxyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface MessageStackInterface extends MessageInterface
{
    /**
     * @param MessageInterface $message
     *
     * @return MessageStackInterface
     */
    public function addMessage(MessageInterface $message): MessageStackInterface;

    /**
     * @return MessageInterface
     */
    public function popMessage(): MessageInterface;

    /**
     * @inheritDoc
     */
    public function getCurrentMessage(): MessageInterface;
}