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

namespace Vainyl\Http\Application\Decorator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Http\Application\HttpApplicationInterface;
use Vainyl\Http\Factory\ResponseFactoryInterface;
use Vainyl\Http\Stack\RequestStackInterface;
use Vainyl\Http\Stack\ResponseStackInterface;

/**
 * Class HttpStackApplicationDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpStackApplicationDecorator extends AbstractHttpApplicationDecorator
{
    private $requestStack;

    private $responseStack;

    private $responseFactory;

    /**
     * HttpStackApplicationDecorator constructor.
     *
     * @param HttpApplicationInterface $httpApplication
     * @param RequestStackInterface    $requestStack
     * @param ResponseStackInterface   $responseStack
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(
        HttpApplicationInterface $httpApplication,
        RequestStackInterface $requestStack,
        ResponseStackInterface $responseStack,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->requestStack = $requestStack;
        $this->responseStack = $responseStack;
        $this->responseFactory = $responseFactory;
        parent::__construct($httpApplication);
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->requestStack->addRequest($request);
        $this->responseStack->addResponse($this->responseFactory->createResponse());
        parent::handle($request);

        return $this->responseStack->popResponse();
    }
}