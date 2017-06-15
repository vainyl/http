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
use Psr\Log\LoggerInterface;
use Vainyl\Http\EmitterInterface;

/**
 * Class LoggerEmitterDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerEmitterDecorator extends AbstractEmitterDecorator
{
    private $logger;

    /**
     * LoggerEmitterDecorator constructor.
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
    public function send(ResponseInterface $response): EmitterInterface
    {
        $this->logger->debug(sprintf('Sending response %s', json_encode($response)));
        parent::send($response);
        $this->logger->debug('Response sent');

        return $this;
    }
}