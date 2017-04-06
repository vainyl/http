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

namespace Vainyl\Http\Decorator;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class AbstractMessageDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMessageDecorator implements MessageInterface
{
    protected $message;

    /**
     * AbstractRequestDecorator constructor.
     *
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->message->getProtocolVersion();
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($protocol)
    {
        $copy = clone $this;
        $copy->message = $this->message->withProtocolVersion($protocol);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->message->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return $this->message->hasHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->message->getHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->message->getHeaderLine($name);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        $copy = clone $this;
        $copy->message = $this->message->withHeader($name, $value);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        $copy = clone $this;
        $copy->message = $this->message->withAddedHeader($name, $value);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        $copy = clone $this;
        $copy->message = $this->message->withoutHeader($name);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->message->getBody();
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        $copy = clone $this;
        $copy->message = $this->message->withBody($body);

        return $copy;
    }
}