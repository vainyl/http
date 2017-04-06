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

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AbstractServerRequestDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method ServerRequestInterface getMessage
 */
abstract class AbstractServerRequestDecorator extends AbstractRequestDecorator implements ServerRequestInterface
{
    /**
     * AbstractServerRequestDecorator constructor.
     *
     * @param ServerRequestInterface $serverRequest
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        parent::__construct($serverRequest);
    }

    /**
     * @inheritDoc
     */
    public function getServerParams()
    {
        return $this->getMessage()->getServerParams();
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams()
    {
        return $this->getMessage()->getCookieParams();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withCookieParams($cookies);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams()
    {
        return $this->getMessage()->getQueryParams();
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withQueryParams($query);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles()
    {
        return $this->getMessage()->getUploadedFiles();
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withUploadedFiles($uploadedFiles);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody()
    {
        return $this->getMessage()->getParsedBody();
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withParsedBody($data);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes()
    {
        return $this->getMessage()->getAttributes();
    }

    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        return $this->getMessage()->getAttribute($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withAttribute($name, $value);

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name)
    {
        $copy = clone $this;
        $copy->message = $this->getMessage()->withoutAttribute($name);

        return $copy;
    }

}