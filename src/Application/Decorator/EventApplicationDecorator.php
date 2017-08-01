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

namespace Vainyl\Http\Application\Decorator;

/**
 * Class EventApplicationDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventApplicationDecorator extends AbstractHttpApplicationDecorator
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