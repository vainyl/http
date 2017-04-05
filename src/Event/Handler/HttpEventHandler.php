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

namespace Vainyl\Http\Event\Handler;

use Vain\Core\Event\Handler\AbstractEventHandler;
use Vain\Core\Event\Resolver\EventResolverInterface;
use Vainyl\Http\Event\RequestEventInterface;
use Vainyl\Http\Event\ResponseEventInterface;
use Vain\Logger\LoggerInterface;

/**
 * Class HttpEventHandler
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpEventHandler extends AbstractEventHandler implements
    RequestEventHandlerInterface,
    ResponseEventHandlerInterface
{
    private $logger;

    private $logHeader;

    /**
     * DynamicLogger constructor.
     *
     * @param EventResolverInterface $resolver
     * @param LoggerInterface   $logger
     * @param string            $logHeader
     */
    public function __construct(EventResolverInterface $resolver, LoggerInterface $logger, string $logHeader)
    {
        $this->logger = $logger;
        $this->logHeader = $logHeader;
        parent::__construct($resolver);
    }

    /**
     * @inheritDoc
     */
    public function request(RequestEventInterface $event) : RequestEventHandlerInterface
    {
        $request = $event->getRequest();
        if (false === $request->hasHeader($this->logHeader)) {
            return $this;
        }
        $this->logger->overrideLevel($request->getHeader($this->logHeader));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function response(ResponseEventInterface $event) : ResponseEventHandlerInterface
    {
        $this->logger->restoreLevel();

        return $this;
    }
}