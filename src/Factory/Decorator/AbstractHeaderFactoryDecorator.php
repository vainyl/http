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

use Vainyl\Http\Factory\HeaderFactoryInterface;
use Vainyl\Http\HeaderInterface;

/**
 * Class AbstractHeaderFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractHeaderFactoryDecorator implements HeaderFactoryInterface
{
    private $headerFactory;

    /**
     * AbstractHeaderFactoryDecorator constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     */
    public function __construct(HeaderFactoryInterface $headerFactory)
    {
        $this->headerFactory = $headerFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->headerFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function createHeader(string $name, $values): HeaderInterface
    {
        return $this->headerFactory->createHeader($name, $values);
    }
}