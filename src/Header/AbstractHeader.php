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

namespace Vainyl\Http\Header;

/**
 * Class AbstractHeader
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHeader implements VainHeaderInterface
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
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name) : VainHeaderInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValues() : array
    {
        return $this->values;
    }

    /**
     * @inheritDoc
     */
    public function setValues(array $values) : VainHeaderInterface
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addValue($value) : VainHeaderInterface
    {
        $this->values = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __toString() : string
    {
        return sprintf('%s: %s', $this->getName(), implode(', ', $this->getValues()));
    }
}