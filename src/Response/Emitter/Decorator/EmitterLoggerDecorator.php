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

namespace Vainyl\Http\Response\Emitter\Decorator;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Psr\Log\LoggerInterface;
use Vainyl\Http\Response\Emitter\EmitterInterface;

/**
 * Class EmitterLoggerDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EmitterLoggerDecorator extends AbstractEmitterDecorator
{
    private $logger;

    /**
     * EmitterLoggerDecorator constructor.
     *
     * @param EmitterInterface $emitter
     * @param LoggerInterface  $logger
     */
    public function __construct(EmitterInterface $emitter, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($emitter);
    }

    /**
     * @inheritDoc
     */
    public function send(HttpResponseInterface $response): EmitterInterface
    {
        $this->logger->debug(sprintf('Sending response %s', implode(PHP_EOL, $response->toDisplay())));
        parent::send($response);
        $this->logger->debug('Response sent');

        return $this;
    }
}