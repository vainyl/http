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

namespace Vainyl\Http\Response\Emitter\Factory\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Http\Response\Emitter\Decorator\EmitterLoggerDecorator;
use Vainyl\Http\Response\Emitter\EmitterInterface;
use Vainyl\Http\Response\Emitter\Factory\EmitterFactoryInterface;

/**
 * Class EmitterFactoryLoggerDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EmitterFactoryLoggerDecorator extends AbstractEmitterFactoryDecorator
{
    private $logger;

    /**
     * EmitterFactoryLoggerDecorator constructor.
     *
     * @param EmitterFactoryInterface $emitterFactory
     * @param LoggerInterface         $logger
     */
    public function __construct(EmitterFactoryInterface $emitterFactory, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($emitterFactory);
    }

    /**
     * @inheritDoc
     */
    public function createEmitter(): EmitterInterface
    {
        return new EmitterLoggerDecorator(parent::createEmitter(), $this->logger);
    }
}