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

namespace Vainyl\Http\Application;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Core\Application\AbstractApplication;
use Vainyl\Http\Factory\ResponseFactoryInterface;

/**
 * Class HttpApplication
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpApplication extends AbstractApplication implements HttpApplicationInterface
{
    private $responseFactory;

    /**
     * HttpApplication constructor.
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
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->responseFactory->createResponse();
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'app';
    }
}