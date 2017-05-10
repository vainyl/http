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

use Psr\Http\Message\ResponseInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Http\Response;

/**
 * Class ResponseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ResponseFactory extends AbstractIdentifiable implements ResponseFactoryInterface
{
    private $streamFactory;

    private $headerFactory;

    private $headerStorage;

    /**
     * ResponseFactory constructor.
     *
     * @param HeaderFactoryInterface $headerFactory
     * @param StreamFactoryInterface $streamFactory
     * @param \ArrayAccess           $headerStorage
     */
    public function __construct(
        HeaderFactoryInterface $headerFactory,
        StreamFactoryInterface $streamFactory,
        \ArrayAccess $headerStorage
    ) {
        $this->headerFactory = $headerFactory;
        $this->streamFactory = $streamFactory;
        $this->headerStorage = $headerStorage;
    }

    /**
     * @inheritDoc
     */
    public function createResponse(int $statusCode = 200): ResponseInterface
    {
        return new Response(
            $statusCode,
            $this->headerFactory,
            $this->streamFactory->createStream(),
            clone $this->headerStorage
        );
    }
}