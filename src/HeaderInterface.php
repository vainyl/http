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

namespace Vainyl\Http;

use Vainyl\Core\NameableInterface;
use Vainyl\Core\StringInterface;

/**
 * Interface HeaderInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HeaderInterface extends NameableInterface, StringInterface
{
    /**
     * @param string $name
     *
     * @return HeaderInterface
     */
    public function withName(string $name): HeaderInterface;

    /**
     * @param array $values
     *
     * @return HeaderInterface
     */
    public function withValues(array $values): HeaderInterface;

    /**
     * @return array
     */
    public function getValues(): array;

    /**
     * @param string $value
     *
     * @return HeaderInterface
     */
    public function withAddedValue($value): HeaderInterface;
}