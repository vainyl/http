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

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Http\Factory\HttpFactoryInterface;

/**
 * Class AbstractHttpFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractHttpFactoryDecorator implements HttpFactoryInterface
{
    private $httpFactory;

    /**
     * AbstractHttpFactoryDecorator constructor.
     *
     * @param HttpFactoryInterface $httpFactory
     */
    public function __construct(HttpFactoryInterface $httpFactory)
    {
        $this->httpFactory = $httpFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->httpFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function createRequest(
        array $server,
        array $serverRequest,
        array $query,
        array $body,
        array $files,
        array $cookies
    ): ServerRequestInterface {
        return $this->httpFactory->createRequest($server, $serverRequest, $query, $body, $files, $cookies);
    }

    /**
     * @inheritDoc
     */
    public function createResponse(int $code = 200, array $headers, string $content): ResponseInterface
    {
        return $this->httpFactory->createResponse($code, $headers, $content);
    }
}