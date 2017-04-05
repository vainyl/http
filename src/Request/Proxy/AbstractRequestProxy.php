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

namespace Vainyl\Http\Request\Proxy;

use Psr\Http\Message\UriInterface;
use Vainyl\Http\Message\Proxy\AbstractMessageProxy;
use Vainyl\Http\Request\VainServerRequestInterface;

/**
 * Class AbstractRequestProxy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method VainServerRequestInterface getCurrentMessage
 */
abstract class AbstractRequestProxy extends AbstractMessageProxy implements HttpRequestProxyInterface
{
    /**
     * @inheritDoc
     */
    public function addRequest(VainServerRequestInterface $request) : HttpRequestProxyInterface
    {
        return $this->addMessage($request);
    }

    /**
     * @inheritDoc
     */
    public function popRequest() : VainServerRequestInterface
    {
        return $this->popMessage();
    }

    /**
     * @inheritDoc
     */
    public function getCurrentRequest() : VainServerRequestInterface
    {
        return $this->getCurrentMessage();
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget() : string
    {
        return $this->getCurrentMessage()->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withRequestTarget($requestTarget);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMethod() : string
    {
        return $this->getCurrentMessage()->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withMethod($method);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUri() : UriInterface
    {
        return $this->getCurrentMessage()->getUri();
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withUri($uri, $preserveHost);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasQueryParam(string $name)
    {
        return $this->getCurrentRequest()->hasQueryParam($name);
    }

    /**
     * @inheritDoc
     */
    public function getQueryParam(string $name, $default = null)
    {
        return $this->getCurrentRequest()->getQueryParam($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function hasCookieParam(string $name) : bool
    {
        return $this->getCurrentRequest()->hasCookieParam($name);
    }

    /**
     * @inheritDoc
     */
    public function getCookieParam(string $name, $default = null)
    {
        return $this->getCurrentRequest()->getCookieParam($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function getContents() : string
    {
        return $this->getCurrentRequest()->getContents();
    }

    /**
     * @inheritDoc
     */
    public function getServer($name, $default = null)
    {
        return $this->getCurrentRequest()->getServer($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function hasServer($name)
    {
        return $this->getCurrentRequest()->hasServer($name);
    }

    /**
     * @inheritDoc
     */
    public function hasBodyParam(string $name)
    {
        return $this->getCurrentRequest()->hasBodyParam($name);
    }

    /**
     * @inheritDoc
     */
    public function getContentType()
    {
        return $this->getCurrentRequest()->getContentType();
    }

    /**
     * @inheritDoc
     */
    public function getUserAgent()
    {
        return $this->getCurrentRequest()->getUserAgent();
    }

    /**
     * @inheritDoc
     */
    public function getServerAddress()
    {
        return $this->getCurrentRequest()->getServerAddress();
    }

    /**
     * @inheritDoc
     */
    public function getServerName()
    {
        return $this->getCurrentRequest()->getServerName();
    }

    /**
     * @inheritDoc
     */
    public function getHttpHost()
    {
        return $this->getCurrentRequest()->getHttpHost();
    }

    /**
     * @inheritDoc
     */
    public function getHttpPort()
    {
        return $this->getCurrentRequest()->getHttpPort();
    }

    /**
     * @inheritDoc
     */
    public function isPost()
    {
        return $this->getCurrentRequest()->isPost();
    }

    /**
     * @inheritDoc
     */
    public function isGet()
    {
        return $this->getCurrentRequest()->isGet();
    }

    /**
     * @inheritDoc
     */
    public function isPut()
    {
        return $this->getCurrentRequest()->isPut();
    }

    /**
     * @inheritDoc
     */
    public function getScheme()
    {
        return $this->getCurrentRequest()->getScheme();
    }

    /**
     * @inheritDoc
     */
    public function isHead()
    {
        return $this->getCurrentRequest()->isHead();
    }

    /**
     * @inheritDoc
     */
    public function isDelete()
    {
        return $this->getCurrentRequest()->isDelete();
    }

    /**
     * @inheritDoc
     */
    public function isOptions()
    {
        return $this->getCurrentRequest()->isOptions();
    }

    /**
     * @inheritDoc
     */
    public function isPurge()
    {
        return $this->getCurrentRequest()->isPurge();
    }

    /**
     * @inheritDoc
     */
    public function isTrace()
    {
        return $this->getCurrentRequest()->isTrace();
    }

    /**
     * @inheritDoc
     */
    public function isConnect()
    {
        return $this->getCurrentRequest()->isConnect();
    }

    /**
     * @inheritDoc
     */
    public function isSecureRequest()
    {
        return $this->getCurrentRequest()->isSecureRequest();
    }

    /**
     * @inheritDoc
     */
    public function getBodyParam(string $name, $default = null)
    {
        return $this->getCurrentMessage()->getBodyParam($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function getServerParams() : array
    {
        return $this->getCurrentMessage()->getServerParams();
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams() : array
    {
        return $this->getCurrentMessage()->getCookieParams();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withCookieParams($cookies);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams() : array
    {
        return $this->getCurrentMessage()->getQueryParams();
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query) : VainServerRequestInterface
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
    public function withUploadedFiles(array $uploadedFiles) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withUploadedFiles($uploadedFiles);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody() : array
    {
        return $this->getCurrentMessage()->getParsedBody();
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withParsedBody($data);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes() : array
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
    public function withAttribute($name, $value) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withAttribute($name, $value);
        $this->addRequest($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name) : VainServerRequestInterface
    {
        $request = $this->popMessage()->withoutAttribute($name);
        $this->addRequest($request);

        return $this;
    }
}