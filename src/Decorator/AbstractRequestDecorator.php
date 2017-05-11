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

namespace Vainyl\Http\Decorator;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class AbstractRequestDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method RequestInterface getMessage
 */
abstract class AbstractRequestDecorator extends AbstractMessageDecorator implements RequestInterface
{
    /**
     * AbstractRequestDecorator constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request);
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        return $this->getMessage()->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withRequestTarget($requestTarget);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return $this->getMessage()->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withMethod($method);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->getMessage()->getUri();
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withUri($uri, $preserveHost);

        return $copy;
    }
}