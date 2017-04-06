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

use Ds\PriorityQueue;
use Ds\Vector;
use Vainyl\Core\Id\AbstractIdentifiable;
use Vainyl\Http\Exception\CannotExtractHeadersException;
use Vainyl\Http\Provider\HeaderProviderInterface;

/**
 * Class HeaderProviderChain
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HeaderProviderChain extends AbstractIdentifiable implements HeaderProviderInterface
{
    private $factories;

    private $queue;

    /**
     * ConfigSourceChain constructor.
     */
    public function __construct()
    {
        $this->factories = new Vector();
        $this->queue = new PriorityQueue();
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
        $this->queue->push($headerProvider, $priority);

        return $this->configure();
    }

    /**
     * @return HeaderProviderChain
     */
    public function configure(): HeaderProviderChain
    {
        $queue = clone $this->queue;
        $list = new Vector();

        while (false === $queue->isEmpty()) {
            $list->push($queue->pop());
        }

        $this->factories = $list;

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
        foreach (clone $this->factories as $factory) {
            if (null === ($headers = $factory->getHeaders($data))) {
                continue;
            }

            return $headers;
        }

        throw new CannotExtractHeadersException($this, $data);
    }
}