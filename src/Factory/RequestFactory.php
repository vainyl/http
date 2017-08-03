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

namespace Vainyl\Http\Factory;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Http\Request;
use Vainyl\Http\ServerRequest;

/**
 * Class RequestFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class RequestFactory extends AbstractIdentifiable implements RequestFactoryInterface
{
    private $headerFactory;

    private $cookieFactory;

    private $streamFactory;

    private $headerStorage;

    private $cookieStorage;

    private $fileStorage;

    /**
     * RequestFactory constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     * @param CookieFactoryInterface $cookieFactory
     * @param StreamFactoryInterface $streamFactory
     * @param \ArrayAccess           $headerStorage
     * @param \ArrayAccess           $cookieStorage
     * @param \ArrayAccess           $fileStorage
     */
    public function __construct(
        HeaderFactoryInterface $headerFactory,
        CookieFactoryInterface $cookieFactory,
        StreamFactoryInterface $streamFactory,
        \ArrayAccess $headerStorage,
        \ArrayAccess $cookieStorage,
        \ArrayAccess $fileStorage
    ) {
        $this->headerFactory = $headerFactory;
        $this->cookieFactory = $cookieFactory;
        $this->streamFactory = $streamFactory;
        $this->headerStorage = $headerStorage;
        $this->cookieStorage = $cookieStorage;
        $this->fileStorage = $fileStorage;
    }

    /**
     * @inheritDoc
     */
    public function createRequest(string $method, UriInterface $uri): RequestInterface
    {
        return new Request(
            $this->headerFactory,
            clone $this->headerStorage,
            $method,
            $uri,
            $this->streamFactory->createStream()
        );
    }

    /**
     * @inheritDoc
     */
    public function createServerRequest(string $method, UriInterface $uri): ServerRequestInterface
    {
        return new ServerRequest(
            $this->headerFactory,
            $this->cookieFactory,
            clone $this->headerStorage,
            clone $this->cookieStorage,
            clone $this->fileStorage,
            $method,
            $uri,
            $this->streamFactory->createStream()
        );
    }

    /**
     * @inheritDoc
     */
    public function create(array $requestData): ServerRequestInterface
    {
        trigger_error('Method create is not implemented', E_USER_ERROR);
    }
}