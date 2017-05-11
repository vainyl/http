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
use Vainyl\Core\Application\Decorator\AbstractApplicationDecorator;
use Vainyl\Http\Application\HttpApplicationInterface;

/**
 * Class AbstractHttpApplicationDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHttpApplicationDecorator extends AbstractApplicationDecorator implements HttpApplicationInterface
{
    private $httpApplication;

    /**
     * AbstractHttpApplicationDecorator constructor.
     *
     * @param HttpApplicationInterface $httpApplication
     */
    public function __construct(HttpApplicationInterface $httpApplication)
    {
        $this->httpApplication = $httpApplication;
        parent::__construct($httpApplication);
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->httpApplication->handle($request);
    }
}