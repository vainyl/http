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

namespace Vainyl\Http\Factory\Decorator;

use Vainyl\Http\EmitterInterface;
use Vainyl\Http\Factory\EmitterFactoryInterface;

/**
 * Class AbstractEmitterFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEmitterFactoryDecorator implements EmitterFactoryInterface
{
    private $emitterFactory;

    /**
     * AbstractEmitterFactoryDecorator constructor.
     *
     * @param EmitterFactoryInterface $emitterFactory
     */
    public function __construct(EmitterFactoryInterface $emitterFactory)
    {
        $this->emitterFactory = $emitterFactory;
    }

    /**
     * @inheritDoc
     */
    public function createEmitter(): EmitterInterface
    {
        return $this->emitterFactory->createEmitter();
    }
}