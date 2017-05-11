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

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class RequestStack
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method ServerRequestInterface getCurrentMessage
 */
class RequestStack extends AbstractMessageStack implements RequestStackInterface
{
    /**
     * @inheritDoc
     */
    public function addRequest(ServerRequestInterface $request): RequestStack
    {
        return $this->addMessage($request);
    }

    /**
     * @inheritDoc
     */
    public function popRequest(): ServerRequestInterface
    {
        return $this->popMessage();
    }

    /**
     * @return ServerRequestInterface
     */
    public function getCurrentRequest(): ServerRequestInterface
    {
        return $this->getCurrentMessage();
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget(): string
    {
        return $this->getCurrentMessage()->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget): ServerRequestInterface
    {
        $request = $this->popMessage()->withRequestTarget($requestTarget);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->getCurrentMessage()->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method): ServerRequestInterface
    {
        $request = $this->popMessage()->withMethod($method);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): UriInterface
    {
        return $this->getCurrentMessage()->getUri();
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false): ServerRequestInterface
    {
        $request = $this->popMessage()->withUri($uri, $preserveHost);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getServerParams(): array
    {
        return $this->getCurrentMessage()->getServerParams();
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams(): array
    {
        return $this->getCurrentMessage()->getCookieParams();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        $request = $this->popMessage()->withCookieParams($cookies);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams(): array
    {
        return $this->getCurrentMessage()->getQueryParams();
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query): ServerRequestInterface
    {
        $request = $this->popMessage()->withQueryParams($query);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles()
    {
        return $this->getCurrentMessage()->getUploadedFiles();
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        $request = $this->popMessage()->withUploadedFiles($uploadedFiles);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody(): array
    {
        return $this->getCurrentMessage()->getParsedBody();
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data): ServerRequestInterface
    {
        $request = $this->popMessage()->withParsedBody($data);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes(): array
    {
        return $this->getCurrentMessage()->getAttributes();
    }

    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        return $this->getCurrentMessage()->getAttribute($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value): ServerRequestInterface
    {
        $request = $this->popMessage()->withAttribute($name, $value);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name): ServerRequestInterface
    {
        $request = $this->popMessage()->withoutAttribute($name);
        $this->addRequest($request);

        return $this;
    }
}