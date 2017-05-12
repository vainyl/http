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
use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Http\Application\HttpApplicationInterface;
use Vainyl\Http\Factory\ResponseFactoryInterface;

/**
 * Class ExceptionApplicationDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ExceptionApplicationDecorator extends AbstractHttpApplicationDecorator
{
    private $responseFactory;

    /**
     * ExceptionApplicationDecorator constructor.
     *
     * @param HttpApplicationInterface $application
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(
        HttpApplicationInterface $application,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->responseFactory = $responseFactory;
        parent::__construct($application);
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = parent::handle($request);
        } catch (AbstractCoreException $exception) {
            $response = $this->responseFactory
                ->createResponse($exception->getCode())
                ->getBody()
                ->write($exception->getMessage());
        } catch (\Exception $exception) {
            $response = $this->responseFactory
                ->createResponse(500)
                ->getBody()
                ->write($exception->getMessage());
        }

        return $response;
    }
}