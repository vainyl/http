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

use Psr\Log\LoggerInterface;
use Vainyl\Http\EmitterInterface;
use Vainyl\Http\Factory\EmitterFactoryInterface;

/**
 * Class LoggerEmitterFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerEmitterFactoryDecorator extends AbstractEmitterFactoryDecorator
{
    private $logger;

    /**
     * LoggerEmitterFactoryDecorator constructor.
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
        return new LoggerEmitterDecorator(parent::createEmitter(), $this->logger);
    }
}