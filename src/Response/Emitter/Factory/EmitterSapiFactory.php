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

namespace Vainyl\Http\Response\Emitter\Factory;

use Vainyl\Http\Response\Emitter\EmitterInterface;
use Vainyl\Http\Response\Emitter\Sapi\SapiEmitter;

/**
 * Class EmitterSapiFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EmitterSapiFactory implements EmitterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createEmitter(): EmitterInterface
    {
        return new SapiEmitter();
    }
}