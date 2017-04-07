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

namespace Vainyl\Http\Exception;

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Http\Provider\HeaderProviderInterface;

/**
 * Class AbstractHeaderProviderException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHeaderProviderException extends AbstractCoreException implements HeaderProviderExceptionInterface
{
    private $provider;

    /**
     * AbstractHeaderProviderException constructor.
     *
     * @param HeaderProviderInterface $provider
     * @param string                  $message
     * @param int                     $code
     * @param \Exception|null         $previous
     */
    public function __construct(
        HeaderProviderInterface $provider,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->provider = $provider;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getProvider(): HeaderProviderInterface
    {
        return $this->provider;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['provider' => $this->provider->getName()], parent::toArray());
    }
}
