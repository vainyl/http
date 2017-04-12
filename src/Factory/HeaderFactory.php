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

namespace Vainyl\Http\Factory;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Http\Header;
use Vainyl\Http\HeaderInterface;

/**
 * Class HeaderFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HeaderFactory extends AbstractIdentifiable implements HeaderFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createHeader(string $name, $values): HeaderInterface
    {
        return new Header($name, $values);
    }
}