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

use Psr\Http\Message\StreamInterface;
use Vainyl\Http\Factory\StreamFactoryInterface;

/**
 * Class AbstractStreamFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractStreamFactoryDecorator implements StreamFactoryInterface
{
    private $streamFactory;

    /**
     * AbstractStreamFactoryDecorator constructor.
     *
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(StreamFactoryInterface $streamFactory)
    {
        $this->streamFactory = $streamFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->streamFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function createStream(string $content = ''): StreamInterface
    {
        return $this->streamFactory->createStream($content);
    }

    /**
     * @inheritDoc
     */
    public function createResource($resource): StreamInterface
    {
        return $this->streamFactory->createResource($resource);
    }
}