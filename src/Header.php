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

use Vainyl\Core\AbstractIdentifiable;

/**
 * Class Header
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Header extends AbstractIdentifiable implements HeaderInterface
{
    private $name;

    private $values = [];

    /**
     * AbstractHeader constructor.
     *
     * @param string $name
     * @param array  $values
     */
    public function __construct($name, array $values = [])
    {
        $this->name = $name;
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function withName(string $name): HeaderInterface
    {
        $copy = clone $this;
        $copy->name = $name;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @inheritDoc
     */
    public function withValues(array $values): HeaderInterface
    {
        $copy = clone $this;
        $copy->values = $values;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function withAddedValue($value): HeaderInterface
    {
        $copy = clone $this;
        $copy->values[] = $value;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return sprintf('%s: %s', $this->getName(), implode(', ', $this->getValues()));
    }
}