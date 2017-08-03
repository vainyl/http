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

use Ds\Stack;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractMessageStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMessageStack implements MessageStackInterface
{
    private $stack;

    /**
     * MessageStack constructor.
     */
    public function __construct()
    {
        $this->stack = new Stack();
    }

    /**
     * @inheritDoc
     */
    public function addMessage(MessageInterface $message): MessageStackInterface
    {
        $this->stack->push($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function popMessage(): MessageInterface
    {
        return $this->stack->pop();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentMessage(): MessageInterface
    {
        return $this->stack->peek();
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->getCurrentMessage()->getProtocolVersion();
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        $message = $this->popMessage()->withProtocolVersion($version);
        $this->addMessage($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->getCurrentMessage()->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name): bool
    {
        return $this->getCurrentMessage()->hasHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->getCurrentMessage()->getHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name): string
    {
        return $this->getCurrentMessage()->getHeaderLine($name);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        $message = $this->popMessage()->withHeader($name, $value);
        $this->addMessage($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        $message = $this->popMessage()->withAddedHeader($name, $value);
        $this->addMessage($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        $message = $this->popMessage()->withoutHeader($name);
        $this->addMessage($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->getCurrentMessage()->getBody();
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        $message = $this->popMessage()->withBody($body);
        $this->addMessage($message);

        return $this;
    }
}