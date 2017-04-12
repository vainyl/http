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
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Vainyl\Http\Factory\RequestFactoryInterface;

/**
 * Class AbstractRequestFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractRequestFactoryDecorator implements RequestFactoryInterface
{
    private $requestFactory;

    /**
     * AbstractRequestFactoryDecorator constructor.
     *
     * @param RequestFactoryInterface $requestFactory
     */
    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->requestFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function createRequest(string $method, UriInterface $uri): RequestInterface
    {
        return $this->requestFactory->createRequest($method, $uri);
    }

    /**
     * @inheritDoc
     */
    public function createServerRequest(string $method, UriInterface $uri): ServerRequestInterface
    {
        return $this->requestFactory->createServerRequest($method, $uri);
    }

    /**
     * @inheritDoc
     */
    public function create(array $requestData): ServerRequestInterface
    {
        return $this->requestFactory->create($requestData);
    }
}