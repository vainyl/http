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
declare(strict_types = 1);

namespace Vainyl\Http\Event\Factory;

use Vain\Core\Event\Resolver\EventResolverInterface;
use Vainyl\Http\Event\HttpEvent;
use Vainyl\Http\Request\VainServerRequestInterface;
use Vainyl\Http\Response\VainResponseInterface;

/**
 * Class HttpEventFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpEventFactory implements HttpEventFactoryInterface
{

    private $resolver;

    /**
     * HttpEventFactory constructor.
     *
     * @param EventResolverInterface $resolver
     */
    public function __construct(EventResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @inheritDoc
     */
    public function createRequestEvent(VainServerRequestInterface $request)
    {
        return new HttpEvent($this->resolver->createName('http', 'request'), $request);
    }

    /**
     * @inheritDoc
     */
    public function createResponseEvent(VainResponseInterface $response)
    {
        return new HttpEvent($this->resolver->createName('http', 'response'), null, $response);
    }

}