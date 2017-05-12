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
 */
class RequestStack extends AbstractMessageStack implements RequestStackInterface
{
    /**
     * @inheritDoc
     */
    public function addRequest(ServerRequestInterface $request): RequestStackInterface
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
        return $this->getCurrentRequest()->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget): ServerRequestInterface
    {
        $request = $this->popRequest()->withRequestTarget($requestTarget);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->getCurrentRequest()->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method): ServerRequestInterface
    {
        $request = $this->popRequest()->withMethod($method);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): UriInterface
    {
        return $this->getCurrentRequest()->getUri();
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false): ServerRequestInterface
    {
        $request = $this->popRequest()->withUri($uri, $preserveHost);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getServerParams(): array
    {
        return $this->getCurrentRequest()->getServerParams();
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams(): array
    {
        return $this->getCurrentRequest()->getCookieParams();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        $request = $this->popRequest()->withCookieParams($cookies);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams(): array
    {
        return $this->getCurrentRequest()->getQueryParams();
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query): ServerRequestInterface
    {
        $request = $this->popRequest()->withQueryParams($query);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles()
    {
        return $this->getCurrentRequest()->getUploadedFiles();
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        $request = $this->popRequest()->withUploadedFiles($uploadedFiles);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody(): array
    {
        return $this->getCurrentRequest()->getParsedBody();
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data): ServerRequestInterface
    {
        $request = $this->popRequest()->withParsedBody($data);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes(): array
    {
        return $this->getCurrentRequest()->getAttributes();
    }

    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        return $this->getCurrentRequest()->getAttribute($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value): ServerRequestInterface
    {
        $request = $this->popRequest()->withAttribute($name, $value);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name): ServerRequestInterface
    {
        $request = $this->popRequest()->withoutAttribute($name);
        $this->addRequest($request);

        return $this;
    }
}