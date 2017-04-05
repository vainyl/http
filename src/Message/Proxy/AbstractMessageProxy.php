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

use Psr\Http\Message\StreamInterface;
use Vainyl\Http\Header\Storage\HeaderStorageInterface;
use Vainyl\Http\Message\VainMessageInterface;
use Vainyl\Http\Stream\VainStreamInterface;

/**
 * Class AbstractMessageProxy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMessageProxy implements HttpMessageProxyInterface
{
    private $messageStack;

    /**
     * AbstractMessageProxy constructor.
     */
    public function __construct()
    {
        $this->messageStack = new \SplStack();
    }

    /**
     * @inheritDoc
     */
    public function getHeaderStorage() : HeaderStorageInterface
    {
        return $this->getCurrentMessage()->getHeaderStorage();
    }

    /**
     * @inheritDoc
     */
    public function getStream() : VainStreamInterface
    {
        return $this->getCurrentMessage()->getStream();
    }

    /**
     * @return \SplStack
     */
    public function getMessageStack()
    {
        return $this->messageStack;
    }

    /**
     * @inheritDoc
     */
    public function addMessage(VainMessageInterface $message)
    {
        $this->messageStack->push($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function popMessage()
    {
        return $this->messageStack->pop();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentMessage()
    {
        return $this->messageStack->top();
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
    public function hasHeader($name) : bool
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
    public function getHeaderLine($name) : string
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

    /**
     * @inheritDoc
     */
    public function withContentType(string $contentType) : VainMessageInterface
    {
        $message = $this->popMessage()->withContentType($contentType);
        $this->addMessage($message);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toDisplay(): array
    {
        return $this->getCurrentMessage()->toDisplay();
    }
}