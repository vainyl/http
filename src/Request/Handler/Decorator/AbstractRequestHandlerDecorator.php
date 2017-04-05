<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */

namespace Vainyl\Http\Request\Handler\Decorator;

use Psr\Http\Message\ServerRequestInterface;
use Vainyl\Http\Request\Handler\RequestHandlerInterface;

/**
 * Class AbstractRequestHandlerDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractRequestHandlerDecorator implements RequestHandlerInterface
{
    private $requestHandler;

    /**
     * AbstractRequestHandlerDecorator constructor.
     *
     * @param RequestHandlerInterface $requestHandler
     */
    public function __construct(RequestHandlerInterface $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $serverRequest)
    {
        return $this->requestHandler->handle($serverRequest);
    }
}