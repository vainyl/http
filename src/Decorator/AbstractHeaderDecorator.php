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

use Vainyl\Http\HeaderInterface;

/**
 * Class AbstractHeaderDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHeaderDecorator implements HeaderInterface
{
    private $header;

    /**
     * AbstractHeaderDecorator constructor.
     *
     * @param HeaderInterface $header
     */
    public function __construct(HeaderInterface $header)
    {
        $this->header = $header;
    }

    /**
     * @inheritDoc
     */
    public function withName(string $name): HeaderInterface
    {
        $this->header = $this->header->withName($name);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withValues(array $values): HeaderInterface
    {
        $this->header = $this->header->withValues($values);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValues(): array
    {
        return $this->header->getValues();
    }

    /**
     * @inheritDoc
     */
    public function withAddedValue($value): HeaderInterface
    {
        $this->header = $this->header->withAddedValue($value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->header->getId();
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->header->getName();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->header->__toString();
    }
}