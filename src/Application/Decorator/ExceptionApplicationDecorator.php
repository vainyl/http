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
use Vainyl\Core\Encoder\Storage\EncoderStorageInterface;
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
    private $encoderStorage;

    private $responseFactory;

    /**
     * ExceptionApplicationDecorator constructor.
     *
     * @param HttpApplicationInterface $application
     * @param EncoderStorageInterface  $encoderStorage
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(
        HttpApplicationInterface $application,
        EncoderStorageInterface $encoderStorage,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->encoderStorage = $encoderStorage;
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
            $contentType = $request->hasHeader('Content-Type') ? $request->getHeader('Content-Type') : 'text/html';
            $response = $this->responseFactory
                ->createResponse($exception->getCode())
                ->withHeader('Content-Type', $contentType);
            $response
                ->getBody()
                ->write($this->encoderStorage->getEncoder($contentType)->encode($exception->toArray()));
        } catch (\Exception $exception) {
            $contentType = $request->hasHeader('Content-Type') ? $request->getHeader('Content-Type') : 'text/html';
            $response = $this->responseFactory
                ->createResponse(500)
                ->withHeader('Content-Type', $contentType);
            $response
                ->getBody()
                ->write($exception->getMessage());
        }

        return $response;
    }
}