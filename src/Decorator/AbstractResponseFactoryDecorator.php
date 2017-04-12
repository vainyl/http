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
use Vainyl\Http\Factory\ResponseFactoryInterface;

/**
 * Class AbstractResponseFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractResponseFactoryDecorator implements ResponseFactoryInterface
{
    private $responseFactory;

    /**
     * AbstractResponseFactoryDecorator constructor.
     *
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->responseFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function createResponse(int $statusCode = 200): ResponseInterface
    {
        return $this->responseFactory->createResponse($statusCode);
    }
}