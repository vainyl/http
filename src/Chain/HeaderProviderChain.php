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

namespace Vainyl\Http\Chain;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Collection\VectorInterface;
use Vainyl\Core\Queue\PriorityQueueInterface;
use Vainyl\Http\Exception\CannotExtractHeadersException;
use Vainyl\Http\Provider\HeaderProviderInterface;

/**
 * Class HeaderProviderChain
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HeaderProviderChain extends AbstractIdentifiable implements HeaderProviderInterface
{
    private $queue;

    private $factories;

    /**
     * HeaderProviderChain constructor.
     *
     * @param PriorityQueueInterface $queue
     * @param VectorInterface        $vector
     */
    public function __construct(PriorityQueueInterface $queue, VectorInterface $vector)
    {
        $this->queue = $queue;
        $this->factories = $vector;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'chain';
    }

    /**
     * @param int                     $priority
     * @param HeaderProviderInterface $headerProvider
     *
     * @return HeaderProviderChain
     */
    public function addProvider(int $priority, HeaderProviderInterface $headerProvider): HeaderProviderChain
    {
        $this->queue->enqueue($headerProvider, $priority);

        return $this->configure();
    }

    /**
     * @return HeaderProviderChain
     */
    public function configure(): HeaderProviderChain
    {
        $queue = clone $this->queue;
        $this->factories->clear();

        while (false === $queue->valid()) {
            $this->factories->push($queue->dequeue());
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(array $data): ?array
    {
        /**
         * @var HeaderProviderInterface $factory
         */
        foreach ($this->factories as $factory) {
            if (null === ($headers = $factory->getHeaders($data))) {
                continue;
            }

            return $headers;
        }

        throw new CannotExtractHeadersException($this, $data);
    }
}